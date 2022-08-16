<?php
namespace App\Services;

use App\Models\ArticleComments;

class ArticleCommentsService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return ArticleComments::query()
            ->select([
                'article_comments.id',
                'article_comments.user_id',
                'users.name',
                'article_comments.comment',
                'article_comments.created_at',
                'article_comments.updated_at',
                'article_comments.deleted_at',
            ])
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'article_comments.user_id')
                    ->whereNull('users.deleted_at');
            });
    }

    /**
     * Get articles by id.
     * 
     * @param int $id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByArticleId($id)
    {
        return $this->base()
            ->where('article_comments.article_id', $id)
            ->orderByRaw('article_comments.created_at asc')
            ->get();
    }

    /**
     * Add as an array.
     * 
     * @param array $values
     * @return App\Models\ArticleComments
     */
    public function save($values) {
        $articleComments = new ArticleComments();
        $articleComments->fill($values)->save();
        return $articleComments;
    }

    /**
     * Get articles comment count.
     * 
     * @param array $articleIds 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getArticlesCommentCount(array $articleIds)
    {
        if (empty($articleIds)) {
            return [];
        }

        return \DB::table('article_comments')
            ->select('id', \DB::raw('count(id) as count'))
            ->whereIn('id', $articleIds)
            ->groupBy('id')
            ->get();
    }

    /**
     * Get favorite article ids.
     * 
     * @param int $userId
     * @param int $limit
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getFavoriteArticleIds(int $userId, int $limit)
    {
        return \DB::table('article_comments')
            ->select('article_comments.article_id', \DB::raw('count(article_comments.article_id) as count'))
            ->join('articles', function ($join) use($userId) {
                $join->on('articles.id', '=', 'article_comments.article_id')
                    ->where('articles.user_id', $userId)
                    ->where('articles.status', \Status::ENABLED);
            })
            ->groupBy('article_comments.article_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
    }
}
