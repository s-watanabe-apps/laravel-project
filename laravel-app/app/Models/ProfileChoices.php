<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class ProfileChoices extends Model
{
    use Notifiable;

    protected $table = 'profile_choices';

    public $timestamps = false;
}
