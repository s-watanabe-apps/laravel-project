<?php
namespace App\Services;

use App\Models\Pictures;

class PicturesService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Pictures::query()->select([
                'pictures.id',
                'pictures.title',
                'pictures.file',
                'pictures.comment',
                'pictures.user_id',
                'users.name',
                'pictures.created_at',
            ])
            ->whereNull('pictures.deleted_at')
            ->leftJoin('users', 'pictures.user_id', '=', 'users.id');
    }

    /**
     * Get pictures.
     * 
     * @param string keyword
     * @param int user_id
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPictures(string $keyword = null, int $user_id = null)
    {
        $query = $this->base();

        if (!is_null($keyword)) {
            $keyword = '%' . addcslashes($keyword, '%_\\') . '%';
            $query->where('pictures.title', 'like', $keyword);
        }

        if (!is_null($user_id) && $user_id > 0) {
            $query->where('pictures.user_id', $user_id);
        }

        return $query
            ->orderBy('pictures.created_at', 'desc')
            ->paginate(Pictures::PAGENATE);
    }

    /**
     * Get picture.
     * 
     * @param int id
     * 
     * @return App\Models\Pictures
     */
    public function getPictureById(int $id)
    {
        return $this->base()
            ->where('pictures.id', $id)
            ->first();
    }
}
