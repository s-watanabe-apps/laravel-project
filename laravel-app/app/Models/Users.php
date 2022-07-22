<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
    use SoftDeletes;

    const PAGENATE = 12;

    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function query()
    {
        return parent::query()
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
                'users.enable',
                'users.remember_token',
                'users.created_at',
                'users.updated_at',
                \DB::raw('groups.name as group_name'),
            ])
            ->leftJoin('groups', 'users.group_id', '=', 'groups.id');
    }
}
