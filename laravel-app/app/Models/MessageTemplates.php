<?php

namespace App\Models;

class MessageTemplates extends Model
{
    protected $table = 'message_templates';

    public $timestamps = false;

    const TYPE_CREATE_USER = 1;
}
