<?php
namespace App\Services;

use App\Models\Articles;

class ArticlesService
{
    /**
     * Save articles.
     * 
     * @var int $userId
     * @var int $type
     * @var array $values
     * @return App\Models\Articles
     */
    public function save($userId, $type, $values)
    {
        $articles = new Articles();
        $articles->user_id = $userId;
        $articles->type = $type;
        $articles->enable = true;
        $articles->title = $values['title'];
        $articles->body = $values['body'];
        $articles->save();
        return $articles;
    }

    /**
     * Get article headlines.
     * 
     * @var int $userId
     * @var int $limit
     * @return
     */
    public function getArticleHeadlines($userId, $limit)
    {
        return Articles::query()
            ->where('articles.user_id', $userId)
            ->orderBy('articles.created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
