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
    public function getById(int $id, int $userId)
    {
        $articles = $this->base()
            ->where('articles.id', $id)
            ->first();

        if (!$articles) {
            throw new NotFoundException();
        }

        if ($articles->user_id != $userId) {
            if ($articles->status != \Status::ENABLED) {
                throw new ForbiddenException();
            }
        }

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

        $articles = $this->base()
            ->whereIn('articles.id', $ids)
            ->get();

        return $articles;
    }

    /**
     * Get articles by user id.
     * 
     * @param int $articleUserId
     * @param int $userId
     * @param int $labelId = null
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByUserId(int $articleUserId, int $userId, int $labelId = null)
    {
        $builder = $this->base()
            ->where('articles.user_id', $userId);
        
        if (!is_null($labelId)) {
            $builder->join('article_labels', function($join) use($labelId) {
                $join->on('article_labels.article_id', '=', 'articles.id')
                    ->where('article_labels.label_id', $labelId);
            });
        }
        
        if ($articleUserId != $userId) {
            $builder->where('articles.status', \Status::ENABLED);
        }
        
        $articles = $builder->orderBy('articles.created_at', 'desc')->paginate(Articles::USER_ARTICLES_ON_PAGE);

        foreach ($articles as &$article) {
            $article->body_text = mb_substr(strip_tags($article->body, '<br>'), 0, 120) . '...';
        }

        return $articles;
    }

    /**
     * Get latest article headlines by user id for Cache or Database.
     * 
     * @param int $articleUserId
     * @param int $userId
     * @param int $limit = Articles::HEADLINE_LIMIT
     * @return array[App\Models\Articles]
     */
    public function getLatestArticles(int $articleUserId, int $userId, int $limit = Articles::HEADLINE_LIMIT)
    {
        $articles = new Articles();

        $key = sprintf('%s-latest-%d-%d', $articles->table, $articleUserId, $articleUserId == $userId ? 1 : 0);

        $cache = $this->remember($key, function() use($articleUserId, $userId, $limit) {
            $builder = $this->base()->where('articles.user_id', $articleUserId);

            if ($articleUserId != $userId) {
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
     * @param int $articleUserId
     * @param int $limit = Articles::HEADLINE_LIMIT
     * @return array[App\Models\Articles]
     */
    public function getFavoriteArticles(int $articleUserId, $limit = Articles::HEADLINE_LIMIT)
    {
        $articles = new Articles();

        $key = sprintf('%s-favorite-%d', $articles->table, $articleUserId);

        $cache = $this->remember($key, function() use($articleUserId, $limit) {
            $ids = (new ArticleCommentsService())->getFavoriteArticleIds($articleUserId, $limit);

            $data = $this->getByIds(array_column($ids->toArray(), 'article_id'));
    
            return json_encode($data);
        });

        $data = array_map(function($value) use($articles) {
            return (clone $articles)->bind($value);
        }, $cache);

        return $data;
    }

    /**
     * Register the entered article.
     * 
     * @param App\Http\Requests\ArticlesRequest $request
     * @return App\Models\Articles
     */
    public function saveMemberArticles(ArticlesRequest $request)
    {
        $articles = new Articles();

        $articles->fill([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user->id,
            'type' => Articles::TYPE_MEMBER_ARTICLE,
            'status' => \Status::ENABLED,
        ])->save();

        return $articles;
    }

    /**
     * Update the entered article.
     * 
     * @param App\Http\Requests\ArticlesRequest $request
     * @return
     */
    public function editMemberArticles(ArticlesRequest $request)
    {
        $articles = $this->getById($request->id, $request->user->id);

        if ($articles->user_id != $request->user->id) {
            throw new ForbiddenException();
        }

        $articles->title = $request->title;
        $articles->body = $request->body;
        $articles->save();

        return $articles;
    }
}
