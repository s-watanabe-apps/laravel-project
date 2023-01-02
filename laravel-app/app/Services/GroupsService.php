<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
use App\Models\Groups;
use Illuminate\Support\Facades\Cache;

class GroupsService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Groups::query()
            ->select([
                'groups.id',
                'groups.name',
                'articles.created_at',
                'articles.updated_at',
            ]);
    }

    /**
     * Get articles by id.
     * 
     * @param int $id
     * @param int $userId
     * @return App\Models\Articles
     */
    public function getById(int $id)
    {
        $articles = $this->base()
            ->where('groups.id', $id)
            ->first();

        throw_if(!$articles, NotFoundException::class);

        return $articles;
    }
}
