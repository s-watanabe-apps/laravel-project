<?php
namespace App\Models;

class MessageTemplates extends Model
{
    // Table name.
    public $table = 'message_templates';

    public $timestamps = false;

    const TYPE_CREATE_USER = 1;
}
