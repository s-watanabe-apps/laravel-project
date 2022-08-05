<?php
namespace App\Services;

use App\Models\NavigationMenus;
use Illuminate\Support\Facades\Cache;

class NavigationMenusService extends Service
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
                'navigation_menus.order',
                'navigation_menus.created_at',
                'navigation_menus.updated_at',
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
        $cache = Cache::rememberForever(__METHOD__, function() {
            $data = $this->query()->get();
            return json_encode($data);
        });

        $data = [];
        foreach (json_decode($cache) as $value) {
            $data[] = (new NavigationMenus())->bind($value);
        }

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
        $this->query()->delete();

        for ($index = 0; $index < count($validated['names']); $index++) {
            NavigationMenus::create([
                'name' => $validated['names'][$index],
                'link' => $validated['links'][$index],
                'order' => $validated['orders'][$index],
            ]);
        }

        cache()->forget('navigation_menus');
    }
}
