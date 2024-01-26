<?php
namespace App\Services;

use App\Models\Weathers;
use Illuminate\Support\Facades\Cache;

class WeathersService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Weathers::query()
            ->select([
                'weathers.city_id',
                'weathers.time',
                'weathers.weather_id',
                'weathers.weather_main',
                'weathers.weather_text',
                'weathers.weather_icon',
                'weathers.clouds',
                'weathers.temp',
                'weathers.wind_speed',
                'weathers.rain',
                'weathers.snow',
                'weathers.created_at',
                'weathers.updated_at',
                'weathers.deleted_at',
            ])->orderBy('weathers.time');
    }

    /**
     * Get weathers by city_id and date.
     * 
     * @param int $city_id
     * @param string $date
     * 
     * @return array
     */
    public function get_weathers($city_id, $date)
    {
        $key = sprintf(parent::CACHE_KEY_WEATHERS, $city_id, $date);
        $ttl = (60 * 60 * 24);

        $weathers = $this->remember($key, function() use($city_id, $date) {
            $date_from = date('Y-m-d 00:00:00', strtotime($date));
            $date_to = date('Y-m-d 00:00:00', strtotime($date) + (60 * 60 * 24));

            $items = $this->base()
                ->where('weathers.city_id', '=', $city_id)
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
