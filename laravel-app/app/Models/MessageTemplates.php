<?php
namespace App\Models;

class MessageTemplates extends Model
{
    // Table name.
    public $table = 'message_templates';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;

    // Model constant, template types.
    const TYPE_CREATE_USER = 1;
}
