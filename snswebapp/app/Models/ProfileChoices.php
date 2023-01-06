<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;

class ProfileChoices extends Model
{
    // Table name.
    public $table = 'profile_choices';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = false;
}
