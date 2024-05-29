<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
use App\Http\Requests\ArticlesRequest;
use App\Models\Articles;
use App\Models\Images;
use Illuminate\Support\Facades\Cache;

/**
 * 記事サービスクラス.
 * 
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class ArticlesService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Articles::query()
            ->select([
                'articles.*',
                'users.name',
            ])->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id')
                    ->whereNull('users.deleted_at');
            });
    }

    /**
     * 記事取得.
     * 
     * @param int $id
     * @param int $userId
     * @return App\Models\Articles
     */
    public function get(int $id)
    {
        $articles = $this->base()->where('articles.id', $id)->first();

        throw_if(!$articles, NotFoundException::class);
        //throw_if(!$this->checkAccessRight($articles), ForbiddenException::class);

        return $articles->toArray();
    }

    /**
     * Get articles by ids.
     * 
     * @param array $ids
     * @return App\Models\Articles
     */
    public function getByIds(array $ids)
    {
        if (empty($ids)) {
            return [];
        }

        $articles = $this->base()->whereIn('articles.id', $ids)->get();

        return $articles;
    }

    /**
     * 記事取得(ユーザーID指定).
     * 
     * @param int $userId
     * @param int $labelId = null
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByUserId(int $userId, int $labelId = null)
    {
        $builder = $this->base()
            ->where('articles.user_id', $userId);
        
        if ($labelId > 0) {
            $builder->join('article_labels', function($join) use($labelId) {
                $join->on('article_labels.article_id', '=', 'articles.id')
                    ->where('article_labels.label_id', $labelId);
            });
        }
        
        if ($userId != user()->id) {
            $builder->where('articles.status', \Status::ENABLED);
        }
        
        $articles = $builder->orderBy('articles.created_at', 'desc')->paginate(Articles::USER_ARTICLES_ON_PAGE);

        foreach ($articles as &$article) {
            $article->body_text = mb_substr(strip_tags($article->body, '<br>'), 0, 120) . '...';

            preg_match(Images::PATTERN_IMG, $article->body, $matches);
            if (count($matches) > 1) {
                $article->image = $matches[1];
            }
        }

        return $articles;
    }

    /**
     * ヘッドライン取得.
     * 
     * @param Carbon $date
     * 
     * @return array<App\Models\Articles>
     */
    public function getLatestArticles($date = null)
    {
        if (is_null($date)) {
            $key = sprintf(parent::CACHE_KEY_LATEST_ARTICLES, carbon()->format('Y-m-d'));
        } else {
            $key = sprintf(parent::CACHE_KEY_LATEST_ARTICLES, $date);
        }

        $cache = $this->remember($key, function() use($date) {
            $builder = $this->base();
            if (!is_null($date)) {
                $builder->where('articles.created_at', '<', $date);
            }
            $builder->where('articles.status', \Status::ENABLED);
            $data = $builder
                ->orderBy('articles.created_at', 'desc')
                ->limit(100)
                ->get()
                ->toArray();
            return json_encode($data);
        });

        $data = array_map(function($value) {
            $value['body_text'] = mb_substr(strip_tags($value['body'], '<br>'), 0, 120) . '...';
            preg_match(Images::PATTERN_IMG, $value['body'], $matches);
            if (count($matches) > 1) {
                $value['image'] = $matches[1];
            }

            $value['tags'] = [];

            return $value;
        }, $cache);

        return $data;
    }

    /**
     * ユーザーの記事一覧取得.
     * 
     * @param int $user_id
     * @param int $limit = Articles::HEADLINE_LIMIT
     * @return array
     */
    public function getLatestArticlesByUserId(int $userId, int $limit = Articles::HEADLINE_LIMIT)
    {
        $key = sprintf(parent::CACHE_KEY_LATEST_ARTICLES_BY_USER_ID, $userId, $userId == user()->id ? 1 : 0);

        $data = $this->remember($key, function() use($userId, $limit) {
            $builder = $this->base()->where('articles.user_id', $userId);

            if ($userId != user()->id) {
                $builder->where('articles.status', \Status::ENABLED);
            }

            $data = $builder->orderBy('articles.created_at', 'desc')->limit($limit)->get();

            return json_encode($data);
        });

        return $data;
    }

    /**
     * Get favorite article headlines by user id for Cache or Database.
     * 
     * @param int $userId
     * @param int $limit = Articles::HEADLINE_LIMIT
     * @return array<App\Models\Articles>
     */
    public function getFavoriteArticlesByUserId(int $userId, $limit = Articles::HEADLINE_LIMIT)
    {
        $articles = new Articles();

        $key = sprintf(parent::CACHE_KEY_FAVORITE_ARTICLES_BY_USER_ID, $userId);

        $cache = $this->remember($key, function() use($userId, $limit) {
            $ids = (new ArticleCommentsService())->getFavoriteArticleIds($userId, $limit);

            $data = $this->getByIds(array_column($ids->toArray(), 'article_id'));
    
            return json_encode($data);
        });

        $data = array_map(function($value) use($articles) {
            return (clone $articles)->bind($value);
        }, $cache);

        return $data;
    }

    /**
     * 記事情報新規作成.
     * 
     * @param array $values
     * @return App\Models\Articles
     */
    public function insertArticles(array $values)
    {
        $id = Articles::insertGetId([
            'user_id' => user()->id,
            'type' => Articles::TYPE_MEMBER_ARTICLE,
            'title' => $values['title'],
            'body' => $values['body'],
            'link' => $values['link'],
            'status' => $values['status'],
            'created_at' => carbon(),
        ]);

        return $id;
    }

    /**
     * 記事情報更新.
     * 
     * @param array $values
     * @return App\Models\Articles
     */
    public function updateArticles(array $values) {
        $articles = $this->get($values['id']);
        $this->checkUpdateRight($articles['user_id']);

        $result = Articles::where('articles.id', $values['id'])
            ->update([
                'title' => $values['title'],
                'body' => $values['body'],
                'status' => $values['status'],
                'updated_at' => carbon(),
            ]);

        return $result;
    }

    /**
     * 記事削除.
     * 
     * @param int $id
     * @return App\Models\Articles
     */
    public function deleteArticles($id)
    {
        $articles = $this->get($id);
        $this->checkUpdateRight($articles['user_id']);

        $result = Articles::where('articles.id', $id)
            ->delete();

        return $result;

    }

    /**
     * Get archive months by user id.
     * 
     * @param int $userId
     * @return array
     */
    public function getArchiveMonths(int $userId)
    {
        $key = sprintf(parent::CACHE_KEY_ARTICLE_MONTHS_BY_USER_ID, $userId);

        $cache = $this->remember($key, function() use($userId) {
            $data = \DB::table(function ($query) use ($userId) {
                $query->from('articles')
                    ->selectRaw('date_format(created_at, \'%Y/%m\') as month')
                    ->where('user_id', $userId);
            })->selectRaw('month, count(month) as count')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

            return json_encode($data);
        });

        $data = array_map(function($value) {
            return [
                sprintf('/articles/user?month=%s', $value->month) => sprintf('%s (%d)', $value->month, $value->count),
            ];
        }, $cache);

        return $data;
    }
}
