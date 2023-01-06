<?php
namespace App\Services;

use App\Models\InformationMarks;

class InformationMarksService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return InformationMarks::query()
            ->select([
                'information_marks.id',
                'information_marks.mark',
            ]);
    }

    /**
     * Get all information marks.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->base()
            ->get();
    }

    /**
     * Get all information marks.
     * 
     * @param int information_marks.id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getById($id)
    {
        return $this->base()
            ->where('id', $id)
            ->first();
    }
}
