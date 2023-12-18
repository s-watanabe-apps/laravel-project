<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
use App\Http\Requests\ArticlesRequest;
use App\Models\Articles;
use Illuminate\Support\Facades\Cache;

class ArticlesService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
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
     * @param int $id
     * @param int $userId
     * @return App\Models\Articles
     */
    public function get(int $id)
    {
        $articles = $this->base()->where('articles.id', $id)->first();

        throw_if(!$articles, NotFoundException::class);

        throw_if(!$this->checkAccessRight($articles), ForbiddenException::class);

        return $articles;
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
     * Get articles by user id.
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
        }

        return $articles;
    }

    /**
     * Get latest article headlines for Cache or Database.
     * 
     * @param int $limit = Articles::HEADLINE_LIMIT
     * @return array<App\Models\Articles>
     */
    public function getLatestArticles(int $limit = Articles::HEADLINE_LIMIT)
    {
        $articles = new Articles();

        $cache = $this->remember(parent::CACHE_KEY_LATEST_ARTICLES, function() use($limit) {
            $builder = $this->base();
            $builder->where('articles.status', \Status::ENABLED);
            $data = $builder->orderBy('articles.created_at', 'desc')->limit($limit)->get();
            return json_encode($data);
        });

        $data = array_map(function($value) use($articles) {
            $article = (clone $articles)->bind($value);
            $article->body_text = mb_substr(strip_tags($value->body, '<br>'), 0, 120) . '...';
            return $article;
        }, $cache);

        return $data;
    }

    /**
     * Get latest article headlines by user id for Cache or Database.
     * 
     * @param int $userId
     * @param int $limit = Articles::HEADLINE_LIMIT
     * @return array<App\Models\Articles>
     */
    public function getLatestArticlesByUserId(int $userId, int $limit = Articles::HEADLINE_LIMIT)
    {
        $articles = new Articles();

        //$key = sprintf(parent::CACHE_KEY_LATEST_ARTICLES_BY_USER_ID, $userId, $userId == user()->id ? 1 : 0);
        $key = sprintf(parent::CACHE_KEY_LATEST_ARTICLES_BY_USER_ID, $userId);

        $cache = $this->remember($key, function() use($userId, $limit) {
            $builder = $this->base()->where('articles.user_id', $userId);

            if ($userId != user()->id) {
                $builder->where('articles.status', \Status::ENABLED);
            }

            $data = $builder->orderBy('articles.created_at', 'desc')->limit($limit)->get();

            return json_encode($data);
        });

        $data = array_map(function($value) use($articles) {
            return (clone $articles)->bind($value);
        }, $cache);

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
     * Register or Update the entered article.
     * 
     * @param App\Http\Requests\ArticlesRequest $request
     * @return App\Models\Articles
     */
    public function save(ArticlesRequest $request) {
        if (isset($request->id)) {
            // Update
            $articles = $this->get($request->id);
            throw_if($articles->user_id != user()->id, ForbiddenException::class);

            foreach ($request->validated() as $key => $value) {
                $articles->$key = $value;
            }
        } else {
            // Insert
            $articles = new Articles();
            $values = $request->validated();

            $values['user_id'] = user()->id;
            $values['type'] = Articles::TYPE_MEMBER_ARTICLE;
            $values['status'] = \Status::ENABLED;

            $articles->fill($values);
        }

        $articles->save();
        return $articles;
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
