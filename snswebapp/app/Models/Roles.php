<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Roles extends Model
{
    // Table name.
    public $table = 'roles';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = false;

    // Model constant, roles.
    const SYSTEM = 0;
    const ADMIN = 1;
    const MEMBER = 2;
    const ANONYMOUS = 3;

    /**
     * Get favorite names.
     * 
     * @return [string][string]
     */
    public static function getFavoriteNames()
    {
        return [
            self::SYSTEM => __('strings.profile'),
            self::ADMIN => __('strings.pictures'),
            self::MEMBER => __('strings.pictures'),
            self::ANONYMOUS => __('strings.pictures'),
        ];
    }
}
