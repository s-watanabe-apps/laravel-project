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
     * Get articles by user id.
     * 
     * @param int $articleUserId
     * @param int $userId
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByUserId(int $articleUserId, int $userId)
    {
        $builder = $this->base()
            ->where('articles.user_id', $userId);
        
        if ($articleUserId != $userId) {
            $builder->where('articles.status', \Status::ENABLED);
        }
        
        $articles = $builder->orderBy('articles.created_at', 'desc')->paginate(3);

        foreach ($articles as &$article) {
            $article->body_text = strip_tags($article->body, '<br>');
        }

        return $articles;
    }

    /**
     * Get latest article headlines by user id for Cache or Database.
     * 
     * @param int $articleUserId
     * @param int $userId
     * @param int $limit = 5
     * @return array[App\Models\Articles]
     */
    public function getLatestArticles(int $articleUserId, int $userId, int $limit = 5)
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
     * Add as an array.
     * 
     * @param array $values
     * @return App\Models\Articles
     */
    private function saveArticles(array $values) {
        $articles = new Articles();
        $articles->fill($values)->save();
        return $articles;
    }

    /**
     * Register the entered article.
     * 
     * @param int $userId
     * @param App\Http\Requests\ArticlesRequest $request
     * @return App\Models\Articles
     */
    public function saveMemberArticles(int $userId, ArticlesRequest $request)
    {
        return $this->saveArticles([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $userId,
            'type' => Articles::TYPE_MEMBER_ARTICLE,
            'status' => \Status::ENABLED,
        ]);
    }

    /**
     * Update as an array.
     * 
     * @param int $id
     * @param array $values
     * @return App\Models\Articles
     */
    private function editArticles(int $id, array $values)
    {
        return Articles::where('id', $id)
            ->update($values);
    }

    /**
     * Update the entered article.
     * 
     * @param int $userId
     * @param App\Models\Articles $request
     * @return
     */
    public function editMemberArticles(int $userId, ArticlesRequest $request)
    {
        $articles = $this->getById($request->id);
        if (!$articles) {
            throw new NotFoundException();
        }

        if ($articles->user_id != $userId) {
            throw new ForbiddenException();
        }

        return $this->editArticles($request->id, [
            'title' => $request->title,
            'body' => $request->body,
        ]);
    }
}
