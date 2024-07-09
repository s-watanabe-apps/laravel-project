<?php
namespace App\Models;

class MessageTemplates extends Model
{
    protected $table = 'message_templates';
    protected $primaryKey = 'id';
    public $timestamps = true;

    const TYPE_CREATE_USER = 1;
}
