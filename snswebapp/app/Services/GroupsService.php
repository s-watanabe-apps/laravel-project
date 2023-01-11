<?php
namespace App\Services;

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
                'groups.code',
                'groups.name',
                'groups.description',
                'groups.order',
                'groups.created_at',
                'groups.updated_at',
            ])->orderBy('order');
    }

    /**
     * Get all groups.
     * 
     * @param int $id
     * @param int $userId
     * @return array<App\Models\Groups>
     */
    public function all()
    {
        return $this->base()->get();
    }
}
