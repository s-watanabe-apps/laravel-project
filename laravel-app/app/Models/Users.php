<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    const PAGENATE = 12;

    private $file = null;

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public static function getBaseQuery()
    {
        return self::query()
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
                'users.api_token',
                'users.enable',
                'users.remember_token',
                'users.created_at',
                'users.updated_at',
                \DB::raw('ifnull(profile_images.file, "profiles%2Fno_image.png") as file'),
                \DB::raw('groups.name as group_name'),
            ])
            ->leftJoin('profile_images', 'users.id', '=', 'profile_images.user_id')
            ->leftJoin('groups', 'users.group_id', '=', 'groups.id');
    }

    /**
     * Get enabled users.
     * 
     * @var int users.id
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getUsers()
    {
        return self::getBaseQuery()
            ->where('users.enable', 1)
            ->paginate(self::PAGENATE);
    }

    /**
     * Get enabled users.
     * 
     * @var int users.id
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getAllUsers()
    {
        $sessions = \DB::raw('select user_id, max(last_activity) as last_activity from sessions group by user_id');

        return self::getBaseQuery()
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
    public static function getUser($id)
    {
        return self::getBaseQuery()
            ->where('users.id', $id)->first();
    }


    /**
     * Get birthday users.
     * 
     * @var Carbon[] birthdays
     * @return array
     */
    public static function getBirthdayUsers($birthdays) {
        $builder = self::getBaseQuery();
        
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
    public static function getByEmail($email)
    {
        return self::getBaseQuery()
            ->where('email', $email)->get()->first();
    }

    /**
     * Update api token.
     * 
     * @var int users.id
     * @var string apiToken
     * @return bool
     */
    public static function updateApiToken($id, $apiToken)
    {
        return self::where('id', $id)
            ->update(['api_token' => $apiToken]);
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
        $this->name = $values['name'];
        $this->name_kana = $values['name_kana'];
        $this->birthdate = new Carbon($values['birth_date']);

        $this->save();
        return $this;
    }
}
