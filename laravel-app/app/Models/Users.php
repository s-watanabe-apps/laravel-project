<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
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

    /**
     * Get enabled users.
     * 
     * @var int users.id
     * @return Illuminate\Pagination\LengthAwarePaginator or App\Models\Users
     */
    public static function getUsers($id = null)
    {
        $query = self::query()
            ->select([
                'users.id',
                'users.name',
                'users.role_id',
                'users.name',
                'users.name_kana',
                'users.email',
                'users.email_verified_at',
                'users.password',
                'users.birthyear',
                'users.birthmonth',
                'users.birthday',
                'users.api_token',
                'users.enabled',
                'users.remember_token',
                'users.created_at',
                'users.updated_at',
                \DB::raw('ifnull(profile_images.file, "profiles%2Fno_image.png") as file'),
            ])
            ->leftJoin('profile_images', 'users.id', '=', 'profile_images.user_id')
            ->where('users.enabled', 1);

        if (is_null($id)) {
            return $query->paginate(self::PAGENATE);
        } else {
            return $query->where('users.id', $id)->get();
        }
    }

    /**
     * Get birthday users.
     * 
     * @var Carbon[] birthdays
     * @return array
     */
    public static function getBirthdayUsers($birthdays) {
        $builder = self::query();
        
        $dateStrings = [];
        foreach ($birthdays as $birthday) {
            $builder->orWhere(function($query) use($birthday) {
                $query->where('birthmonth', $birthday->format('n'))
                      ->where('birthday', $birthday->format('j'));
            });
        }

        return $builder->orderBy('id')->get();
    }

    /**
     * Get by id.
     * 
     * @var int users.id
     * @return App\Models\Users
     */
    public static function getById($id)
    {
        return self::getUsers($id)->first();
    }

    /**
     * Get by E-mail
     * 
     * @var string email
     * @return App\Models\Users
     */
    public static function getByEmail($email)
    {
        return self::query()->where('email', $email)->get()->first();
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
     * Get by api token.
     * 
     * @var string apiToken
     * @return App\Models\Users
     */
    public static function getByApiToken($apiToken)
    {
        return self::query()
            ->where('api_token', $apiToken)
            ->get()->first();
    }

    /**
     * Get birthdate.
     * 
     * @return Carbon\Carbon
     */
    public function getBirthDate()
    {
        return (new Carbon(
            $this->birthyear . '-' .
            $this->birthmonth . '-' .
            $this->birthday))->format('Y-m-d');
    }

    /**
     * Save users.
     * 
     * @var array
     * @return App\Models\Users
     */
    public function saveUsers($values)
    {
        $birthDate = new Carbon($values['birth_date']);

        $this->name = $values['name'];
        $this->name_kana = $values['name_kana'];
        $this->birthyear = $birthDate->format('Y');
        $this->birthmonth = $birthDate->format('n');
        $this->birthday = $birthDate->format('j');

        $this->save();
        return $this;
    }
}
