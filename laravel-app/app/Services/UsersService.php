<?php
namespace App\Services;

use App\Models\Users;
use App\Libs\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersService
{
    /**
     * Get enabled users.
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUsers()
    {
        return Users::query()
            ->where('users.status', Status::ENABLED)
            ->paginate(Users::PAGENATE);
    }

    /**
     * Get enabled users.
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllUsers()
    {
        $sessions = \DB::raw('select user_id, max(last_activity) as last_activity from sessions group by user_id');

        return Users::query()
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
        return Users::query()
            ->where('users.id', $id)
            ->first();
    }

    /**
     * Get birthday users.
     * 
     * @var Carbon[] birthdays
     * @return array
     */
    public function getBirthdayUsers($birthdays) {
        $builder = Users::query();
        
        $dateStrings = [];
        foreach ($birthdays as $birthday) {
            $builder->orWhere(function($query) use($birthday) {
                $query->where(\DB::raw('date_format(birthdate, "%m")'), $birthday->format('m'))
                      ->where(\DB::raw('date_format(birthdate, "%d")'), $birthday->format('d'));
            });
        }

        return $builder->orderBy('id')->get();
    }

    /**
     * Get by E-mail
     * 
     * @var string email
     * @return App\Models\Users
     */
    public function getByEmail($email)
    {
        return Users::query()
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
        return Users::where('id', $id)
            ->update(['api_token' => $apiToken]);
    }

    /**
     * Get birthdate.
     * 
     * @return Carbon\Carbon
     */
    public function getBirthDate($birthdate)
    {
        return (new Carbon($birthdate))->format('Y-m-d');
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
