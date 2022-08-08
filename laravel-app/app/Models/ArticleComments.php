<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleComments extends Model
{
    use SoftDeletes;

    public $table = 'article_comments';

    // Multiple assignable attributes.
    protected $fillable = [
        'article_id',
        'user_id',
        'comment',
    ];
}
