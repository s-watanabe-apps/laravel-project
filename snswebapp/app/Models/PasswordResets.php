<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class PasswordResets extends Model
{
    // Table name.
    public $table = 'password_resets';

    // Primary key.
    protected $primaryKey = 'email';

    public $timestamps = false;

    public $incrementing = false;
}