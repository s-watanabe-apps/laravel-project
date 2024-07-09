<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
    use SoftDeletes;

    protected $table = 'articles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'type',
        'status',
        'title',
        'body',
    ];

    // 記事タイプ定数.
    const TYPE_MEMBER_ARTICLE = 1;

    // ページング定数.
    const USER_ARTICLES_ON_PAGE = 8;
    const HEADLINE_LIMIT = 5;
}
