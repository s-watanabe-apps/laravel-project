<?php
namespace App\Services;

use App\Models\Pictures;

class PicturesService extends Service
{
    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Pictures::query()->select([
                'pictures.id',
                'pictures.title',
                'pictures.file',
                'pictures.comment',
                \DB::raw('users.id as user_id'),
                'users.name',
                'pictures.created_at',
            ])
            ->whereNull('pictures.deleted_at')
            ->leftJoin('users', 'pictures.user_id', '=', 'users.id');
    }

    /**
     * Get pictures.
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPictures()
    {
        return $this->query()
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
        return $this->query()
            ->where('pictures.id', $id)
            ->first();
    }
}
