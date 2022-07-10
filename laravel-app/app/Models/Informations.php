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

    /**
     * Get enabled informations.
     * 
     * @return array
     */
    public static function getEnabled() {
        $now = new Carbon();
        return self::query()
            ->addSelect([\DB::raw('datediff(now(), informations.start_time) <= 7 as is_new'),])
            ->where('status', self::STATUS_ENABLE)
            ->where('start_time', '<=', $now)
            ->where(function($query) use($now) {
                $query->where('end_time', '>=', $now)
                      ->orWhereNull('end_time');
            })->orderBy('start_time')
            ->get();
    }

    public static function all($columns = [])
    {
        return self::query()->get();
    }

    public static function get($id)
    {
        return self::query()->where(['informations.id' => $id])->get()->first();
    }


    /**
     * Add as an array.
     * 
     * @var array
     * @return App\Models\FreePages
     */
    public static function add($values) {
        $informations = new Informations();
        $informations->fill($values)->save();
        return $informations;
    }
}
