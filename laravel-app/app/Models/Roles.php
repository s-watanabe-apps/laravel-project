<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Roles extends Model
{
    // Table name.
    public $table = 'roles';

    // Model constants.
    public $timestamps = false;

    const ADMIN = 1;
    const MEMBER = 2;
    const ANONYMOUS = 3;
}
