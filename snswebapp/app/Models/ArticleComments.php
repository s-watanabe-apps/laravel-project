<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleComments extends Model
{
    use SoftDeletes;

    protected $table = 'article_comments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'article_id',
        'user_id',
        'comment',
    ];
}
