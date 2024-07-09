<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;

class ProfileChoices extends Model
{
    protected $table = 'profile_choices';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
