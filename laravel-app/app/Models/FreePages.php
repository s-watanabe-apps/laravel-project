<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreePages extends Model
{
    /**
     * Multiple assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'title',
        'body',
    ];
}
