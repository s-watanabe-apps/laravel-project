<?php
namespace App\Services;

use App\Models\Articles;

class ArticlesService
{
    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Articles::query()
            ->select([
                'articles.id',
                'articles.user_id',
                'users.name',
                'articles.type',
                'articles.status',
                'articles.title',
                'articles.body',
                'articles.created_at',
                'articles.updated_at',
                'articles.deleted_at',
            ])->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id')
                    ->whereNull('users.deleted_at');
            });
    }

    /**
     * Get articles by id.
     * 
     * @param int articles.id
     * @return App\Models\Articles
     */
    public function getById($id)
    {
        return $this->query()
            ->where('articles.id', $id)
            ->first();
    }

    /**
     * Get articles by user id.
     * 
     * @param int users.id
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByUserId($userId)
    {
        $articles = $this->query()
            ->where('articles.user_id', $userId)
            ->orderBy('articles.created_at', 'desc')
            ->paginate(3);

        foreach ($articles as &$article) {
            $article->body_text = strip_tags($article->body, '<br>');
        }

        return $articles;
    }

    /**
     * Add as an array.
     * 
     * @param array
     * @return App\Models\Articles
     */
    public function save($values) {
        $articles = new Articles();
        $articles->fill($values)->save();
        return $articles;
    }

    /**
     * Get article headlines by user id.
     * 
     * @var int users.id
     * @var int limit
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getArticleHeadlines($userId, $limit)
    {
        return $this->query()
            ->where('articles.user_id', $userId)
            ->orderBy('articles.created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
