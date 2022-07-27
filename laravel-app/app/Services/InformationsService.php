<?php
namespace App\Services;

use App\Models\Informations;
use App\Models\InformationMarks;

class InformationsService
{
    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function query() {
        return Informations::query()
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
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getEnabled() {
        $now = carbon();
        return $this->query()
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
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all($columns = [])
    {
        return $this->query()->get();
    }

    /**
     * Get informations by id.
     * 
     * @return array
     */
    public function get($id)
    {
        return $this->query()->where(['informations.id' => $id])->get()->first();
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

    public function getInformationMark($id)
    {
        $result = InformationMarks::query(['mark'])->where('id', $id)->first();
        return $result->mark;
    }
}
