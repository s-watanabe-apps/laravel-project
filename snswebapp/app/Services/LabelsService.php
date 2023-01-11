<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Models\Labels;

class LabelsService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Labels::query()
            ->select([
                'labels.id',
                'labels.value',
            ]);
    }

    /**
     * Get labels by id.
     * 
     * @param int $id
     * @return array
     */
    public function get(int $id)
    {
        $data = $this->base()->where('labels.id', $id)->first();

        if (!$data) {
            throw new NotFoundException();
        }

        return $data;
    }

    /**
     * Get labels by ids.
     * 
     * @param array $ids
     * @return array
     */
    public function getByIds(array $ids)
    {
        return $this->base()->whereIn('labels.id', $ids)->get();
    }
}
