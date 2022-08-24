<?php
namespace App\Models;

class FreePages extends Model
{
    // Table name.
    public $table = 'free_pages';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;

    // Multiple assignable attributes.
    protected $fillable = [
        'code',
        'title',
        'body',
    ];
}
