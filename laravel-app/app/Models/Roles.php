<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Roles extends Model
{
    const ADMIN = 1;
    const MEMBER = 2;

    use Notifiable;

    protected $table = 'roles';

    public $timestamps = false;
}
