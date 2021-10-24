<?php

namespace App\Models;

use App\Models\Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Articles extends Model
{
    use SoftDeletes;
    use Notifiable;

    const TYPE_MEMBER_ARTICLE = 1;

    protected $table = 'articles';

    /**
     * Save articles.
     * 
     * @var int users.id
     * @var int articles.type
     * @var array
     * @return void
     */
    public static function saveArticles($userId, $type, $values)
    {
        $articles = new Articles();
        $articles->user_id = $userId;
        $articles->type = $type;
        $articles->enable = true;
        $articles->title = $values['title'];
        $articles->body = $values['body'];
        $articles->save();

/*
        $extensions = Images::getExtensions();
        $mimeTypes = str_replace('/', '\/', implode('|', array_keys($extensions)));
        $pattern = sprintf('/data:(%s);base64,([0-9a-zA-Z\/+=]*)\/?/', $mimeTypes);
        preg_match_all($pattern, $values['body'], $matchs);

        $files = [];
        foreach ($matchs[2] as $key => $value) {
            $files[$key] = $extensions[$matchs[1][$key]];
            $values['body'] = str_replace($value, ":article-image-{$key}:", $values['body']);
        }

        $articles->body = $values['body'];
        $articles->save();

        foreach ($matchs[2] as $key => $value) {
            Images::saveImages(null, $value, Images::TYPE_ARTICLE_IMAGE, $articles->id, $key);
        }
*/
    }

    public static function getBaseQuery()
    {
        return self::query()
            ->select([
                'articles.id',
                'articles.user_id',
                'users.name',
                'articles.type',
                'articles.title',
                'articles.body',
                'articles.created_at',
                'articles.updated_at',
                'articles.deleted_at',
            ])
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id')
                    ->whereNull('users.deleted_at');
            });
    }

    public static function getArticleHeadlines($userId, $limit)
    {
        return self::query()
            ->select([
                'articles.id',
                'articles.title',
                'articles.created_at',
            ])
            ->where('articles.user_id', $userId)
            ->orderBy('articles.created_at', 'desc')
            ->limit($limit)
            ->get()->toArray();
    }
}
