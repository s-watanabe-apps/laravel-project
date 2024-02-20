<?php
namespace App\Services;

use App\Models\Themes;
use Illuminate\Support\Facades\Cache;

class ThemesService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Themes::query()
            ->select([
                'themes.*',
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
