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
    public function query()
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
     * @return App\Models\Articles
     */
    public function getById(int $id)
    {
        return $this->query()
            ->where('articles.id', $id)
            ->first();
    }

    /**
     * Get articles by user id.
     * 
     * @param int users.id
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByUserId(int $userId)
    {
        $articles = $this->query()
            ->where('articles.user_id', $userId)
            ->orderBy('articles.created_at', 'desc')
            ->paginate(3);

        foreach ($articles as &$article) {
            $article->body_text = strip_tags($article->body, '<br>');
        }

        return $articles;
    }

    /**
     * Add as an array.
     * 
     * @param array
     * @return App\Models\Articles
     */
    public function save(array $values) {
        $articles = new Articles();
        $articles->fill($values)->save();
        return $articles;
    }

    public function saveMemberArticles(int $userId, ArticlesRequest $request)
    {
        return $this->save([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $userId,
            'type' => Articles::TYPE_MEMBER_ARTICLE,
            'status' => Status::ENABLED,
        ]);
    }

    public function edit(int $id, array $values)
    {
        return Articles::where('id', $id)
            ->update($values);
    }

    public function editMemberArticles(int $userId, ArticlesRequest $request)
    {
        $articles = $this->getById($request->id);
        if (!$articles) {
            throw new NotFoundException();
        }

        if ($articles->user_id != $userId) {
            throw new ForbiddenException();
        }

        return $this->edit($request->id, [
            'title' => $request->title,
            'body' => $request->body,
        ]);
    }

    /**
     * Get article headlines by user id.
     * 
     * @var int users.id
     * @var int limit
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getArticleHeadlines(int $userId, int $limit)
    {
        return $this->query()
            ->where('articles.user_id', $userId)
            ->orderBy('articles.created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
