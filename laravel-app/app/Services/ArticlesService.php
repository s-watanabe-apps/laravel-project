<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
use App\Models\Articles;
use App\Http\Requests\ArticlesRequest;
use App\Libs\Status;

class ArticlesService
{
    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function query()
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
     * @param int articles.user_id
     * @return App\Models\Articles
     */
    public function getById(int $id, int $userId)
    {
        $articles = $this->query()
            ->where('articles.id', $id)
            ->first();

        if (!$articles) {
            throw new NotFoundException();
        }

        if ($articles->user_id != $userId) {
            if ($articles->status != Status::ENABLED) {
                throw new ForbiddenException();
            }
        }

        return $articles;
    }

    /**
     * Get articles by user id.
     * 
     * @param int articleUserId
     * @param int userId
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByUserId(int $articleUserId, int $userId)
    {
        $builder = $this->query()
            ->where('articles.user_id', $userId);
        
        if ($articleUserId != $userId) {
            $builder->where('articles.status', Status::ENABLED);
        }
        
        $articles = $builder->orderBy('articles.created_at', 'desc')
            ->paginate(3);

        foreach ($articles as &$article) {
            $article->body_text = strip_tags($article->body, '<br>');
        }

        return $articles;
    }

    /**
     * Get article headlines by user id.
     * 
     * @var int users.id
     * @var int limit
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getLatestArticleHeadlines(int $articleUserId, int $userId, int $limit = 5)
    {
        $builder = $this->query()
            ->where('articles.user_id', $articleUserId);

        if ($articleUserId != $userId) {
            $builder->where('articles.status', Status::ENABLED);
        }

        return $builder->orderBy('articles.created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Add as an array.
     * 
     * @param array
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
     * @param App\Http\Requests\ArticlesRequest
     * @return App\Models\Articles
     */
    public function saveMemberArticles(int $userId, ArticlesRequest $request)
    {
        return $this->saveArticles([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $userId,
            'type' => Articles::TYPE_MEMBER_ARTICLE,
            'status' => Status::ENABLED,
        ]);
    }

    /**
     * Update as an array.
     * 
     * @param int articles.id
     * @param array
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
     * @param int userId
     * @param App\Models\Articles
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
