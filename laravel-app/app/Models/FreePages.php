<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreePages extends Model
{
    // Multiple assignable attributes.
    protected $fillable = [
        'code',
        'title',
        'body',
    ];
}
