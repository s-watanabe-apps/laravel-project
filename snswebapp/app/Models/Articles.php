<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
    use SoftDeletes;

    // Table name.
    public $table = 'articles';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;

    // Model constant, article types.
    const TYPE_MEMBER_ARTICLE = 1;

    // Model constant, article acquisition limits.
    const USER_ARTICLES_ON_PAGE = 8;
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
