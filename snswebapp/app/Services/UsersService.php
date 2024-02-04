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

class UsersService extends Service
{
    /**
     * Get base query builder builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Users::query()
            ->select([
                'users.id',
                'users.name',
                'users.role_id',
                \DB::raw('roles.name as role_name'),
                'users.name',
                'users.name_kana',
                'users.email',
                'users.email_verified_at',
                'users.password',
                'users.birthdate',
                \DB::raw('ifnull(users.image_file, "profiles%2Fno_image.png") as image_file'),
                'users.api_token',
                'users.status',
                'users.remember_token',
                'users.created_at',
                'users.updated_at',
                'users.group_code',
                \DB::raw('groups.name as group_name'),
            ])
            ->leftJoin('groups', 'users.group_code', '=', 'groups.code')
            ->join('roles', 'users.role_id', '=', 'roles.id');
            //->where('users.role_id', '!=', Roles::SYSTEM);
    }

    /**
     * ユーザー一覧取得.
     * 
     * @param string keyword
     * @param int group_code
     * @param bool pagenation
     * 
     * @return array
     */
    public function get_enabled_users(string $keyword = null, string $group_code = null, $pagenation = true)
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
     * ユーザー一覧取得.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $sessions = \DB::raw('select user_id, max(last_activity) as last_activity from sessions group by user_id');

        return $this->base()
            ->addSelect(['sessions.last_activity'])
            ->leftJoin(\DB::raw('(select user_id, max(last_activity) as last_activity from sessions group by user_id) sessions'),
                'users.id', '=', 'sessions.user_id')
            ->get()
            ->toArray();
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
     * Send password reset mail.
     * 
     * @param string $email
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

            $subject = sprintf("[%s] %s", settings()->site_name, __('strings.reset_password'));
            $template = implode('.', ['emails', \App::getLocale(), 'reset_password']);

            Mail::to($email)->send(new ContactMail($subject, $template, $data));
        } else {
            sleep(2);
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
