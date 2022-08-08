<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
    use SoftDeletes;

    public $table = 'articles';

    // Model constants.
    const TYPE_MEMBER_ARTICLE = 1;

    // Multiple assignable attributes.
    protected $fillable = [
        'user_id',
        'type',
        'status',
        'title',
        'body',
    ];
}
