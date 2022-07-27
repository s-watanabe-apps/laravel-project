<?php
namespace App\Models;

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
}
