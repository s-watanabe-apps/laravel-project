<?php

namespace App\Services;

use App\Models\Articles;

class ArticlesService
{
    /**
     * Save articles.
     * 
     * @var int
     * @var int
     * @var array
     * @return void
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
    }

    /**
     * Get article headlines.
     * 
     * @var int
     * @var int
     * @return void
     */
    public function getArticleHeadlines($userId, $limit)
    {
        return Articles::query()
            ->where('articles.user_id', $userId)
            ->orderBy('articles.created_at', 'desc')
            ->limit($limit)
            ->get()->toArray();
    }
}
