<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class PasswordResets extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'email';
    public $timestamps = false;
    public $incrementing = false;
}