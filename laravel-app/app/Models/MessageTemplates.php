<?php

namespace App\Models;

use Illuminate\Database\Eloquent;

class MessageTemplates extends Eloquent\Model
{
    protected $table = 'message_templates';

    public $timestamps = false;

    const TYPE_CREATE_USER = 1;
}
