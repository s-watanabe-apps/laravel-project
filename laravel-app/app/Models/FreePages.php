<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreePages extends Model
{
    protected $table = 'free_pages';

    // Multiple assignable attributes.
    protected $fillable = [
        'code',
        'title',
        'body',
    ];
}
