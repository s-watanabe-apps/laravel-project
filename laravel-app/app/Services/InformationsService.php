<?php
namespace App\Services;

use App\Libs\Status;
use App\Models\Informations;
use App\Models\InformationMarks;
use App\Requests\ManagementsInformationsRequest;

class InformationsService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base() {
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
        return $this->base()
            ->addSelect([\DB::raw('datediff(now(), informations.start_time) <= 7 as is_new'),])
            ->where('status', Status::ENABLED)
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
        return $this->base()->get();
    }

    /**
     * Get informations by id.
     * 
     * @return array
     */
    public function get($id)
    {
        return $this->base()->where(['informations.id' => $id])->get()->first();
    }


    /**
     * Add as an array.
     * 
     * @var App\Requests\ManagementsInformationsRequest
     * @return App\Models\Informations
     */
    //public function save(ManagementsInformationsRequest $request)
    public function save($request)
    {
        $informations = new Informations();

        $informations->fill($request->validated())->save();

        return $informations;
    }

    public function getInformationMark($id)
    {
        $result = InformationMarks::query(['mark'])->where('id', $id)->first();
        return $result->mark;
    }
}
