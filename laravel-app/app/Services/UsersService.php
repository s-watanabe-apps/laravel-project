<?php
namespace App\Services;

use App\Models\Users;
use App\Libs\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class UsersService
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
     * Get users by id.
     * 
     * @var int id
     * @return App\Models\Users
     */
    public function getUsersById($id)
    {
        return $this->query()
            ->where('users.id', $id)
            ->first();
    }

    /**
     * Get birthday users.
     * 
     * @var Carbon[] birthdays
     * @return array[App\Models\Users]
     */
    public function getBirthdayUsers($birthdays) {
        $dates = [];
        foreach ($birthdays as $birthday) {
            $dates[] = $birthday->toDateString();
        }

        $key = sprintf('birthday_users-%s-%s', $dates[0], $dates[count($dates) - 1]);

        $cache = Cache::remember($key, (60 * 60 * 24), function() use($birthdays) {
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
        });

        $data = [];
        foreach (json_decode($cache) as $value) {
            $data[] = (new Users())->bind($value);
        }

        return $data;
    }

    /**
     * Get by E-mail
     * 
     * @var string email
     * @return App\Models\Users
     */
    public function getByEmail($email)
    {
        return $this->query()
            ->where('email', $email)
            ->first();
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
