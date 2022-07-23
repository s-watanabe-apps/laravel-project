<?php
namespace App\Services;

use App\Models\Articles;

class ArticlesService
{

    public function get($id)
    {
        return Articles::query()->where('articles.id', $id)->first();
    }

    public function getByUserId($userId)
    {
        return Articles::query()->where('articles.user_id', $userId)->get();
    }

    /**
     * Add as an array.
     * 
     * @param array
     * @return App\Models\Articles
     */
    public function add($values) {
        $articles = new Articles();
        $articles->fill($values)->save();
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
