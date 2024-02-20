<?php
namespace App\Services;

use App\Models\NavigationMenus;

class NavigationMenusService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return NavigationMenus::query()->select([
                'navigation_menus.*',
            ])
            ->orderBy('navigation_menus.order', 'asc');
    }

    /**
     * Get all navigation menus for Cache or Database.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $data = $this->remember(parent::CACHE_KEY_NAVIGATION_MENUS, function() {
            $data = $this->base()->get();
            return json_encode($data);
        });

        return $data;
    }

    /**
     * Save navigation menus.
     * 
     * @param array
     * @return void
     */
    public function save($validated)
    {
        $this->base()->delete();

        for ($index = 0; $index < count($validated['names']); $index++) {
            NavigationMenus::create([
                'name' => $validated['names'][$index],
                'link' => $validated['links'][$index],
                'order' => $validated['orders'][$index],
            ]);
        }

        cache()->forget(parent::CACHE_KEY_NAVIGATION_MENUS);
    }
}
