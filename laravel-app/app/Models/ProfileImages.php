<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class ProfileImages extends Model
{
    use Notifiable;

    protected $table = 'profile_images';

    public static function getByUserId($userId)
    {
        return self::query()
            ->where('user_id', $userId)
            ->get()->first();
    }
}
