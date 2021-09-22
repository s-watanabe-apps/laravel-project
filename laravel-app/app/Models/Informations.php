<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent;
use Illuminate\Notifications\Notifiable;

class Informations extends Eloquent\Model
{
    use Notifiable;

    protected $table = 'informations';

    public $timestamps = false;

    /**
     * getEnabled
     * 
     * @return array
     */
    public static function getEnabled() {
        $now = new Carbon();
        return self::query()
            ->select([
                'informations.id',
                'informations.subject',
                'informations.body',
                'informations.enabled',
                'informations.start_time',
                'informations.end_time',
                \DB::raw('datediff(now(), informations.start_time) <= 7 as is_new'),
            ])
            ->where('enabled', 1)
            ->where('start_time', '<=', $now)
            ->where(function($query) use($now) {
                $query->where('end_time', '>=', $now)
                      ->orWhereNull('end_time');
            })->orderBy('start_time')
            ->get();
    }
}
