<?php

namespace App\Services;

use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersService
{
    /**
     * Get enabled users.
     * 
     * @var int users.id
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUsers()
    {
        return Users::query()->where('users.enable', 1)->paginate(self::PAGENATE);
    }

    /**
     * Get enabled users.
     * 
     * @var int users.id
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
     * Get user.
     * 
     * 
     * @var int users.id
     * @return App\Models\Users
     */
    public function getUser($id)
    {
        return Users::query()->where('users.id', $id)->first();
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
        return Users::query()->where('email', $email)->get()->first();
    }

    /**
     * Update api token.
     * 
     * @var int users.id
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
    public function getBirthDate()
    {
        return (new Carbon($this->birthdate))->format('Y-m-d');
    }

    /**
     * Save users.
     * 
     * @var array
     * @return App\Models\Users
     */
    public function saveUsers($values)
    {
        $user = new Users();
        $user->name = $values['name'];
        $user->name_kana = $values['name_kana'];
        $user->birthdate = new Carbon($values['birth_date']);
        $user->image_file = $values['image_file'];

        $user->save();
        return $user;
    }
}
