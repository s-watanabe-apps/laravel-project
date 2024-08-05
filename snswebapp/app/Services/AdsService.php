<?php
namespace App\Services;

use App\Models\Ads;
use Illuminate\Support\Facades\Cache;

/**
 * 広告管理サービスクラス.
 *
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class AdsService extends Service
{
    /**
     * 基本クエリ.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Ads::query()
            ->select([
                'ads.*',
            ])->orderBy('id');
    }

    public function getAdsAll()
    {
        return $this->base()->get()->toArray();
    }
}
