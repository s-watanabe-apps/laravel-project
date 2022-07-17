<?php

namespace App\Services;

use App\Models\Informations;
use Carbon\Carbon;

class InformationsService
{
    /**
     * Get enabled informations.
     * 
     * @return array
     */
    public function getEnabled() {
        $now = new Carbon();
        return Informations::query()
            ->addSelect([\DB::raw('datediff(now(), informations.start_time) <= 7 as is_new'),])
            ->where('status', Informations::STATUS_ENABLE)
            ->where('start_time', '<=', $now)
            ->where(function($query) use($now) {
                $query->where('end_time', '>=', $now)
                      ->orWhereNull('end_time');
            })->orderBy('start_time')
            ->get();
    }

    /**
     * Get all informations.
     * 
     * @return array
     */
    public function all($columns = [])
    {
        return Informations::query()->get();
    }

    /**
     * Get informations by id.
     * 
     * @return array
     */
    public function get($id)
    {
        return Informations::query()->where(['informations.id' => $id])->get()->first();
    }


    /**
     * Add as an array.
     * 
     * @var array
     * @return App\Models\FreePages
     */
    public function add($values) {
        $informations = new Informations();
        $informations->fill($values)->save();
        return $informations;
    }
}
