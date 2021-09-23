<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Notifications\Notifiable;

class Settings extends Eloquent\Model
{
    use Notifiable;

    protected $table = 'settings';

    public $timestamps = false;

    /**
     * get setting.
     * 
     * @return App\Models\Settings
     */
    public static function get() {
        return self::query()->first();
    }
}
