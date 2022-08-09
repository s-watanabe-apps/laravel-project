<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreePages extends Model
{
    // Table name.
    public $table = 'free_pages';

    // Multiple assignable attributes.
    protected $fillable = [
        'code',
        'title',
        'body',
    ];
}
