<?php
namespace App\Services;

use App\Models\Themes;
use Illuminate\Support\Facades\Cache;

class ThemesService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Themes::query()
            ->select([
                'themes.id',
                'themes.name',
                'themes.header_color',
                'themes.text_color',
                'themes.background_color',
                'themes.body_color',
                'themes.border_color',
                'themes.a_color',
                'themes.th_color',
            ]);
    }

    /**
     * テーマ一覧取得.
     * 
     * @return array
     */
    public function all()
    {
        return $this->base()->get()->toArray();
    }
}
