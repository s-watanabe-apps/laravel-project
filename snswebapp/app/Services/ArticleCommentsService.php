<?php
namespace App\Services;

use App\Models\ArticleComments;

class ArticleCommentsService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return ArticleComments::query()
            ->select([
                'article_comments.*',
                \DB::raw('users.name as user_name'),
            ])
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'article_comments.user_id')
                    ->whereNull('users.deleted_at');
            });
    }

    /**
     * 記事に紐づくコメントの取得.
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
     * コメント保存.
     * 
     * @param array $values
     * @return App\Models\ArticleComments
     */
    public function save($userId, $params)
    {
        $articleComments = new ArticleComments();

        $articleComments->user_id = $userId;
        $articleComments->article_id = $params['id'];
        $articleComments->comment = $params['comment'];

        $articleComments->save();

        return $articleComments;
    }

    /**
     * 記事に紐づくコメント件数取得.
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
     * 人気の記事取得.
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
