<?php
namespace App\Services;

use App\Models\ArticleLabels;
use App\Models\Labels;

class ArticleLabelsService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return ArticleLabels::query()
            ->select([
                'article_labels.id',
                'article_labels.article_id',
                'article_labels.label_id',
                'labels.value',
            ])->join('labels', 'article_labels.label_id', '=', 'labels.id');
    }

    /**
     * Get article labels by article id.
     * 
     * @param int $articleId
     * @return array<App\Models\ArticleLabels>
     */
    public function getByArticleId(int $articleId)
    {
        $key = sprintf(parent::CACHE_KEY_ARTICLE_LABELS_BY_ARTICLE_ID, $articleId);

        $cache = $this->remember($key, function() use($articleId) {
            $data = $this->base()
                ->where('article_labels.article_id', $articleId)
                ->get();

            return json_encode($data);
        });

        return array_map(function($value) {
            return (new ArticleLabels())->bind($value);
        }, $cache);
    }

    /**
     * Get article labels by article id.
     * 
     * @param int $userId
     * @return array<App\Models\Labels>
     */
    public function getByUserId(int $userId)
    {
        $key = sprintf(parent::CACHE_KEY_ARTICLE_LABELS_BY_USER_ID, $userId);

        $cache = $this->remember($key, function() use($userId) {
            $temp = ArticleLabels::query()->select([
                    'article_labels.label_id',
                ])
                ->join('articles', function($join) use($userId) {
                    $join->on('articles.id', '=', 'article_labels.article_id')
                        ->where('articles.user_id', $userId)
                        ->where('articles.status', \Status::ENABLED);
                })
                ->groupBy('article_labels.label_id')
                ->get();

            $data = (new LabelsService())->getByIds(array_column($temp->toArray(), 'label_id'));

            return json_encode($data);
        });

        return array_map(function($value) {
            return (new Labels())->bind($value);
        }, $cache);
    }

        /**
     * 人気タグ取得.
     * 
     * @param string $lang 言語
     * @param string $today 現在日
     * 
     * @return array
     */
    public function get_feature_tags($date)
    {
        $key = 'feature-labels';
        $ttl = 60 * 60 * 24;

        $cache = $this->remember($key, function() use($date) {
            $article_labels = ArticleLabels::select([
                    'article_labels.label_id',
                    \DB::raw('count(article_labels.label_id) as count'),
                ])
                ->join('articles', 'article_labels.article_id', '=', 'articles.id')
                ->where('articles.status', 1)
                ->whereNull('articles.deleted_at')
                ->where(function($query) use($date) {
                    $date_to = date('Y-m-d', strtotime("{$date} + 1 days"));
                    $date_from = date('Y-m-d', strtotime("{$date} - 1 months"));
                    $query->whereBetween('articles.created_at', [$date_from, $date_to])
                        ->orWhereBetween('articles.updated_at', [$date_from, $date_to]);
                })
                ->groupBy('article_labels.label_id')
                ->having(\DB::raw('count(article_labels.label_id)'), '>', 0);

            $labels = Labels::select([
                    'labels.id',
                    'labels.value',
                    'relations.count',
                ])->join(\DB::raw("({$article_labels->toSql()}) as relations"), 'labels.id', '=', 'relations.label_id')
                ->orderBy('relations.count', 'desc')
                ->mergeBindings($article_labels->getQuery());

            return json_encode($labels->get()->toArray());
        }, $ttl);

        return $cache;
    }
}
