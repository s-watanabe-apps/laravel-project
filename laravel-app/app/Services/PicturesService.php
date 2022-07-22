<?php
namespace App\Services;

use App\Models\Pictures;

class PicturesService
{
    /**
     * Get pictures.
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPictures()
    {
        return Pictures::query()
            ->orderBy('pictures.created_at', 'desc')
            ->paginate(Pictures::PAGENATE);
    }

    /**
     * Get pictures.
     * 
     * @return App\Models\Pictures
     */
    public function getPictureById($id)
    {
        return Pictures::query()
            ->where('pictures.id', $id)
            ->first();
    }
}
