<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
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
        $cache = $this->remember(parent::CACHE_KEY_INFORMATIONS, function() use($now) {
            $data = $this->base()
                ->addSelect([\DB::raw('datediff(now(), informations.start_time) <= 7 as is_new'),])
                ->where('status', \Status::ENABLED)
                ->where('start_time', '<=', $now)
                ->where(function($query) use($now) {
                    $query->where('end_time', '>=', $now)
                        ->orWhereNull('end_time');
                })->orderBy('start_time')
                ->get();
            return json_encode($data);
        });

        $informations = new Informations();
        $data = array_map(function($value) use($informations) {
            return (clone $informations)->bind($value);
        }, $cache);

        return $data;
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
     * Update or create record.
     * 
     * @var App\Requests\ManagementsInformationsRequest
     * @return App\Models\Informations
     */
    public function save($request)
    {
        if (isset($request->id)) {
            // Update
            $informations = $this->get($request->id);
            throw_if(!$informations, NotFoundException::class);

            foreach ($request->validated() as $key => $value) {
                $informations->$key = $value;
            }
        } else {
            // Insert
            $informations = new Informations();
            $informations->fill($request->validated())->save();
        }

        $informations->status = $request->status ?? \Status::DISABLED;

        $informations->save();

        $this->cacheForget(Service::CACHE_KEY_INFORMATIONS);

        return $informations;
    }

    /**
     * Get information mark.
     * 
     * @param int $id
     * @return int
     */
    public function getInformationMark($id)
    {
        $result = InformationMarks::query(['mark'])->where('id', $id)->first();
        return $result->mark;
    }
}
