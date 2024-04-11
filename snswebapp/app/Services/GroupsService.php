<?php
namespace App\Services;

use App\Models\Groups;
use Illuminate\Support\Facades\Cache;

/**
 * グループサービスクラス.
 * 
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
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
     * グループ全件取得.
     * 
     * @return array
     */
    public function all()
    {
        return $this->base()
            ->get()
            ->toArray();
    }

    /**
     * グループ取得.
     * 
     * @param string $code
     * @return array
     */
    public function getGroupByCode($code)
    {
        return $this->base()
            ->where('code', $code)
            ->first()
            ->toArray();
    }
}
