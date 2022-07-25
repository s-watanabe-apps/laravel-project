<?php
namespace App\Services;

use App\Models\NavigationMenus;

class NavigationMenusService
{
    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return NavigationMenus::query()->select([
                'navigation_menus.id',
                'navigation_menus.name',
                'navigation_menus.link',
                'navigation_menus.sort',
                'navigation_menus.created_at',
                'navigation_menus.updated_at',
            ])
            ->orderBy('navigation_menus.sort', 'asc');
    }

    /**
     * Get all navigation menus.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->query()->get();
    }
}
