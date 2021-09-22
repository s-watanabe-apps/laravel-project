<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Notifications\Notifiable;

class ProfileChoices extends Eloquent\Model
{
    use Notifiable;

    protected $table = 'profile_choices';

    public $timestamps = false;
}
