<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Models\Users;
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
            ->leftJoin('groups', 'users.group_code', '=', 'groups.code');
    }

    /**
     * Get enabled users.
     * 
     * @param string keyword
     * @param int group_code
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
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
            
        return $query->paginate(Users::PAGENATE);
    }

    /**
     * Get enabled users.
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
            ->get();
    }

    /**
     * Get users by id for Cache or Database.
     * 
     * @var int id
     * @return App\Models\Users
     */
    public function get($id) : Users
    {
        $key = sprintf(parent::CACHE_KEY_USERS_BY_ID, $id);

        $cache = $this->remember($key, function() use($id) {
            $data = $this->base()->where('users.id', $id)->first();
            
            if (!$data) {
                throw new NotFoundException();
            }

            return json_encode($data);
        });

        return (new Users())->bind($cache);
    }

    /**
     * Get by E-mail for Cache or Database.
     * 
     * @var string email
     * @return App\Models\Users
     */
    public function getByEmail($email) : Users
    {
        $key = sprintf(parent::CACHE_KEY_USERS_BY_EMAIL, $email);

        $cache = $this->remember($key, function() use($email) {
            $data = $this->base()->where('email', $email)->first();
            return json_encode($data);
        });

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
     * Get birthdate.
     * 
     * @return Carbon\Carbon
     */
    public function getBirthDate($birthdate)
    {
        return carbon($birthdate)->format('Y-m-d');
    }

    /**
     * Save users.
     * 
     * @param array
     * @param int
     * @return App\Models\Users
     */
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
}
