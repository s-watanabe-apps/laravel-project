<?php
namespace App\Services;

use App\Models\Weathers;
use Illuminate\Support\Facades\Cache;

class WeathersService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Weathers::query()
            ->select([
                'weathers.*',
            ])->orderBy('weathers.time');
    }

    /**
     * お天気情報取得.
     * 
     * @param int $cityId
     * @param string $date
     * 
     * @return array
     */
    public function getWeathers($cityId, $date)
    {
        $key = sprintf(parent::CACHE_KEY_WEATHERS, $cityId, $date);
        $ttl = (60 * 60 * 24);

        $weathers = $this->remember($key, function() use($cityId, $date) {
            $date_from = date('Y-m-d 00:00:00', strtotime($date));
            $date_to = date('Y-m-d 00:00:00', strtotime($date) + (60 * 60 * 24));

            $items = $this->base()
                ->where('weathers.city_id', '=', $cityId)
                ->where('weathers.time', '>=', $date_from)
                ->where('weathers.time', '<', $date_to)
                ->get();

            $data = [];
            for ($i = 0; $i < 8; $i++) {
                $time = date('Y-m-d H:i:s', strtotime($date_from) + (60 * 60 * ($i * 3)));
                $is_find = false;
                foreach ($items as $item) {
                    if (strtotime($item->getAttributes()['time']) == strtotime($time)) {
                        $data[$i] = $item->getAttributes();
                        $is_find = true;
                        break;
                    }
                }
                if (!$is_find) {
                    $data[$i]['time'] = $time;
                }
            }

            return json_encode($data);
        }, $ttl);

        return $weathers;
    }
}
