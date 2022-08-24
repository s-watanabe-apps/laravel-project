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
    const ADMIN = 1;
    const MEMBER = 2;
    const ANONYMOUS = 3;
}
