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
     * Multiple assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'mark_id',
        'title',
        'body',
        'status',
        'start_time',
        'end_time',
    ];

    /**
     * Get base query.
     * 
     * @return array
     */
    public static function query() {
        return parent::query()
            ->select([
                'informations.id',
                'informations.mark_id',
                'information_marks.mark',
                'informations.title',
                'informations.body',
                'informations.status',
                'informations.start_time',
                'informations.end_time',
            ])->join('information_marks', 'informations.mark_id', '=', 'information_marks.id');
    }
}
