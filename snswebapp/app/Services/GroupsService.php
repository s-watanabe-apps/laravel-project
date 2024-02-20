<?php
namespace App\Services;

use App\Models\Groups;
use Illuminate\Support\Facades\Cache;

class GroupsService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Groups::query()
            ->select([
                'groups.*',
            ])->orderBy('order');
    }

    /**
     * Get all groups.
     * 
     * @return array<App\Models\Groups>
     */
    public function all()
    {
        return $this->base()
            ->get()
            ->toArray();
    }
}
