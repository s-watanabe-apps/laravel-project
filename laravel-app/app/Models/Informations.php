<?php

namespace App\Models;

use Carbon\Carbon;

class Informations extends Model
{
    protected $table = 'informations';

    public $timestamps = true;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 2;

    public static function getStatuses()
    {
        return [
            self::STATUS_ENABLE => __('strings.enable'),
            self::STATUS_DISABLE => __('strings.disable'),
        ];
    }
    /**
     * Get base query.
     * 
     * @return array
     */
    public static function getBaseQuery() {
        return self::query()
            ->select([
                'informations.id',
                'informations.title',
                'informations.body',
                'informations.status',
                'informations.start_time',
                'informations.end_time',
            ]);
    }

    /**
     * Get enabled informations.
     * 
     * @return array
     */
    public static function getEnabled() {
        $now = new Carbon();
        return self::getBaseQuery()
            ->addSelect([\DB::raw('datediff(now(), informations.start_time) <= 7 as is_new'),])
            ->where('status', self::STATUS_ENABLE)
            ->where('start_time', '<=', $now)
            ->where(function($query) use($now) {
                $query->where('end_time', '>=', $now)
                      ->orWhereNull('end_time');
            })->orderBy('start_time')
            ->get();
    }

    public static function getAllInformations()
    {
        return self::getBaseQuery()->get();
    }
}
