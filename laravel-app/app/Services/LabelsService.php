<?php
namespace App\Services;

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
     * Get labels by ids.
     * 
     * @param int $articleId
     * @return array
     */
    public function getByIds(array $ids)
    {
        return $this->base()->whereIn('labels.id', $ids)->get();
    }
}
