<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
    use SoftDeletes;

    // Primary key.
    protected $primaryKey = 'id';

    // Table name.
    public $table = 'articles';

    // Model constants.
    const TYPE_MEMBER_ARTICLE = 1;

    const USER_ARTICLES_ON_PAGE = 10;
    const HEADLINE_LIMIT = 5;

    // Multiple assignable attributes.
    protected $fillable = [
        'user_id',
        'type',
        'status',
        'title',
        'body',
    ];
}
