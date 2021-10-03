<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent;

class Informations extends Eloquent\Model
{
    protected $table = 'informations';

    public $timestamps = false;

    /**
     * Get base query.
     * 
     * @return array
     */
    public static function getBaseQuery() {
        return self::query()
            ->select([
                'informations.id',
                'informations.subject',
                'informations.body',
                'informations.enable',
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
            ->where('enable', 1)
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
