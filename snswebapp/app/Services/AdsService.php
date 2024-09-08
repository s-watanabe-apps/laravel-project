<?php
namespace App\Services;

use App\Models\Ads;
use App\Http\Requests\ManagementsAdsRequest;
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

    public function getAds()
    {
        $now = carbon();
        $data = $this->remember(parent::CACHE_KEY_ADS, function() use($now) {
            $data = $this->base()
                ->where(function($query) use($now) {
                    $query->where('start_time', '<=', $now)
                        ->orWhereNull('start_time');
                })
                ->where(function($query) use($now) {
                    $query->where('end_time', '>=', $now)
                        ->orWhereNull('end_time');
                })
                ->get()->toArray();
            return json_encode($data);
        });


        $ads = [];
        foreach ($data as $ad) {
            $ads[$ad['type']][] = $ad;
        }

        return $ads;
    }

    public function getAdsAll()
    {
        $result = $this->base()->get()->toArray();

        $ads = [];
        foreach ($result as $ad) {
            $ads[$ad['type']][] = $ad;
        }

        return $ads;
    }

    private function deleteByType($type)
    {
        return Ads::where('type', $type)->delete();
    }

    /**
     * 広告保存.
     *
     * @params array $params
     * @return void
     */
    public function save(ManagementsAdsRequest $request)
    {
        $params = $request->validated();

        $this->deleteByType($params['type']);

        $id = 1;
        foreach ($params['title'] as $key => $title) {
            if (is_null($title)) {
                continue;
            }

            Ads::insert([
                'id' => $id++,
                'type' => $params['type'],
                'title' => $title,
                'body' => $params['body'][$key],
                'start_time' => $params['start_time'][$key],
                'end_time' => $params['end_time'][$key],
            ]);
        }

        $this->cacheForget(Service::CACHE_KEY_ADS);
    }
}
