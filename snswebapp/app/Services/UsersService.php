<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Models\Users;
use App\Models\Roles;
use App\Models\PasswordResets;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

class UsersService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Users::query()
            ->select([
                'users.*',
                \DB::raw('roles.name as role_name'),
                \DB::raw('ifnull(users.image_file, "profiles%2Fno_image.png") as image_file'),
                \DB::raw('groups.name as group_name'),
            ])
            ->leftJoin('groups', 'users.group_code', '=', 'groups.code')
            ->join('roles', 'users.role_id', '=', 'roles.id');
            //->where('users.role_id', '!=', Roles::SYSTEM);
    }

    /**
     * ユーザー一覧取得.
     * 
     * @param string $keyword
     * @param int $group_code
     * 
     * @return array
     */
    public function getEnabledUsers(string $keyword = null, string $group_code = null)
    {
        $query = $this->base()->where('users.status', \Status::ENABLED);
        
        if (!is_null($keyword)) {
            $keyword = '%' . addcslashes($keyword, '%_\\') . '%';
            $query->where('users.name', 'like', $keyword);
        }

        if (!is_null($group_code) && $group_code != '0') {
            $query->where('users.group_code', $group_code);
        }
            
        $result = $query->get();

        return $result->toArray();
    }

    /**
     * ユーザー一覧取得(管理用).
     * 
     * @param string $keyword
     * @param int $group_code
     * @param int $sortkey
     *
     * @return array
     */
    public function getUsersForManagements(string $keyword = null, string $group_code = null, $sortkey = null)
    {
        $sortkey = $sortkey ?? -1;

        $user_management_headers = [
            1 => [
                'sortkey' => 'users.id',
                'header_name' => __('strings.id')
            ],
            2 => [
                'sortkey' => 'users.name',
                'header_name' => __('strings.name'),
            ],
            3 => [
                'sortkey' => 'users.group_code',
                'header_name' => __('strings.group'),
            ],
            4 => [
                'sortkey' => 'users.created_at',
                'header_name' => __('strings.created_at'),
            ],
            5 => [
                'sortkey' => 'sessions.last_activity',
                'header_name' => __('strings.last_login'),
            ],
            6 => [
                'sortkey' => 'users.status',
                'header_name' => __('strings.status'),
            ],
        ];
    
        $sessions = \DB::raw('select user_id, max(last_activity) as last_activity from sessions group by user_id');

        $query = $this->base()
            ->addSelect(['sessions.last_activity'])
            ->leftJoin(\DB::raw('(select user_id, max(last_activity) as last_activity from sessions group by user_id) sessions'),
                'users.id', '=', 'sessions.user_id');

        if (!is_null($keyword)) {
            $like_keyword = '%' . addcslashes($keyword, '%_\\') . '%';
            $query->where('users.name', 'like', $like_keyword);
        }

        if (!is_null($group_code) && $group_code != '0') {
            $query->where('users.group_code', $group_code);
        }

        // 並べ替え
        $sortkey_name = $user_management_headers[abs($sortkey)]['sortkey'];
        $sortkey_order = $sortkey > 0 ? 'asc' : 'desc';
        $query->orderBy($sortkey_name, $sortkey_order);

        $result = $query->get();

        // ヘッダー用のパラメータ
        $query_string = http_build_query([
            'keyword' => $keyword,
            'group_code' => ($group_code != 0) ? '' : $group_code,
        ]);

        // ヘッダー生成
        $headers = array_map(function($key, $value) use($query_string, $sortkey) {
                return [
                    'name' => $value['header_name'] . ($sortkey == $key ? '▲' : ($sortkey == -$key ? '▼' : '')),
                    'link' => "/managements/users?{$query_string}&sort=" . ($sortkey == $key ? -$sortkey : $key),
                ];
            },
            array_keys($user_management_headers),
            array_values($user_management_headers)
        );

        return [$result->toArray(), $headers];
    }

    /**
     * ユーザー情報取得.
     * 
     * @var int id
     * @return array
     */
    public function get($id)
    {
        $key = sprintf(parent::CACHE_KEY_USERS_BY_ID, $id);

        $data = $this->remember($key, function() use($id) {
            $data = $this->base()
                ->addSelect(['sessions.last_activity'])
                ->leftJoin('sessions', 'users.id', '=', 'sessions.user_id')
                ->where('users.id', $id)
                ->orderBy('sessions.last_activity', 'desc')
                ->first();
            
            if (!$data) {
                throw new NotFoundException();
            }

            return json_encode($data);
        });

        return $data;
    }

    /**
     * Get by E-mail for Cache or Database.
     * 
     * @var string email
     * @return App\Models\Users
     */
    public function getByEmail($email)
    {
        $key = sprintf(parent::CACHE_KEY_USERS_BY_EMAIL, $email);

        $cache = $this->remember($key, function() use($email) {
            $data = $this->base()->where('email', $email)->first();
            return json_encode($data);
        });

        if (is_null($cache)) {
            return null;
        }

        return (new Users())->bind($cache);
    }

    /**
     * Get birthday users for Cache or Database.
     * 
     * @var Carbon[] birthdays
     * @return array[App\Models\Users]
     */
    public function getBirthdayUsers($birthdays)
    {
        $users = new Users();

        $dates = array_map(function($value) {
            return $value->toDateString();
        }, $birthdays);

        $key = sprintf(parent::CACHE_KEY_USERS_BY_BIRTHDAY_RANGE, $dates[0], $dates[count($dates) - 1]);

        $cache = $this->remember($key, function() use($birthdays) {
            $builder = $this->base();
        
            $dateStrings = [];
            foreach ($birthdays as $birthday) {
                $builder->orWhere(function($query) use($birthday) {
                    $query->where(\DB::raw('date_format(birthdate, "%m")'), $birthday->format('m'))
                          ->where(\DB::raw('date_format(birthdate, "%d")'), $birthday->format('d'));
                });
            }
    
            $data = $builder->orderBy('id')->get();
            return json_encode($data);
        }, (60 * 60 * 24));

        return array_map(function($value) use($users) {
            return (clone $users)->bind($value);
        }, $cache);
    }

    /**
     * Update api token.
     * 
     * @var int id
     * @var string apiToken
     * @return bool
     */
    public function updateApiToken($id, $apiToken)
    {
        return Users::where('id', $id)->update(['api_token' => $apiToken]);
    }

    /**
     * パスワードリセットメール送信.
     * 
     * @param string $email
     * @return void
     */
    public function sendResetMail(string $email)
    {
        if (($user = $this->base()->where('email', $email)->first()) != null) {
            $expire_in_minutes = 30;
            $token = (new PasswordResets())->issue($user, $expire_in_minutes);

            $encryptToken = Crypt::encryptString($email . ',' . $token);
            
            $data = [
                'name' => $user->name,
                'token' => $encryptToken,
                'expire_in' => $expire_in_minutes . __('strings.expire_in_minutes'),
            ];

            $subject = sprintf("[%s] %s", settings()['site_name'], __('strings.reset_password'));
            $template = implode('.', ['emails', \App::getLocale(), 'reset_password']);

            Mail::to($email)->send(new ContactMail($subject, $template, $data));
        } else {
            sleep(2);
        }
    }

    /**
     * パスワードリセット.
     * 
     * @param string $password
     * @param string $token
     * @return void
     */
    public function resetPassword(string $password, string $token)
    {
        try {
            list($email, $key) = explode(',', Crypt::decryptString($token));
            dump($email, $key);
        } catch (DecryptException $e) {
            abort(500);
        }
    }

    /**
     * Save users.
     * 
     * @param array
     * @param int
     * @return App\Models\Users
     */
/*
    public function save($values, $id = null)
    {
        if ($id == null) {
            $users = (new Users())->bind($values);
            $users->save();
            return $users;
        } else {
            Users::where('id', $id)->update($values);
            return $this->get($id);
        }
    }
*/
}
