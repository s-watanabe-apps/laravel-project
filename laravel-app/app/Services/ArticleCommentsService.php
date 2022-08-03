<?php
namespace App\Services;

use App\Models\ArticleComments;

class ArticleCommentsService
{
    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function query()
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
     * @param int id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByArticleId($id)
    {
        return $this->query()
            ->where('article_comments.article_id', $id)
            ->orderByRaw('article_comments.created_at asc')
            ->get();
    }

    /**
     * Add as an array.
     * 
     * @param array
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
     * @param array
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
}
