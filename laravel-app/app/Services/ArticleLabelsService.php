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
}
