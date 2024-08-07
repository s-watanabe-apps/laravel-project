<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Roles extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // ロールID定数.
    const SYSTEM = 1;
    const ADMIN = 2;
    const MEMBER = 3;
    const ANONYMOUS = 4;
    const API = 5;

    /**
     * ロール名配列取得.
     *
     * @return array
     */
    public static function getRoleNames()
    {
        return [
            self::SYSTEM => __('strings.roles.system'),
            self::ADMIN => __('strings.roles.admin'),
            self::MEMBER => __('strings.roles.member'),
            self::ANONYMOUS => __('strings.roles.anonymous'),
        ];
    }
}
