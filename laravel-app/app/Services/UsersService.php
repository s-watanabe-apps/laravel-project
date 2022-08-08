<?php
namespace App\Services;

use App\Models\Users;
use App\Libs\Status;
use Illuminate\Support\Facades\DB;

class UsersService extends Service
{
    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function query()
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
                \DB::raw('groups.name as group_name'),
            ])
            ->leftJoin('groups', 'users.group_id', '=', 'groups.id');
    }

    /**
     * Get enabled users.
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUsers()
    {
        return $this->query()
            ->where('users.status', Status::ENABLED)
            ->paginate(Users::PAGENATE);
    }

    /**
     * Get enabled users.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        $sessions = \DB::raw('select user_id, max(last_activity) as last_activity from sessions group by user_id');

        return $this->query()
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
    public function getUsersById($id) : Users
    {
        $key = sprintf('users-%d', $id);

        $cache = $this->remember($key, function() use($id) {
            $data = $this->query()->where('users.id', $id)->first();
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
        $key = sprintf('users-%s', $email);

        $cache = $this->remember($key, function() use($email) {
            $data = $this->query()->where('email', $email)->first();
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

        $key = sprintf('%s-birthday-%s-%s', $users->table, $dates[0], $dates[count($dates) - 1]);

        $cache = $this->remember($key, function() use($birthdays) {
            $builder = $this->query();
        
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
        return $this->where('id', $id)
            ->update(['api_token' => $apiToken]);
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
            $users = new Users();
            foreach ($values as $key => $value) {
                $users->$key = $value;
            }
            $users->save();
            return $users;
        } else {
            Users::where('id', $id)->update($values);
            return $this->getUsersById($id);
        }
    }
}
