<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Notifications\Notifiable;

class Roles extends Eloquent\Model
{
    const ADMIN = 1;
    const MEMBER = 2;

    use Notifiable;

    protected $table = 'roles';

    public $timestamps = false;
}
