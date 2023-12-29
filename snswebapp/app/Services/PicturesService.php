<?php
namespace App\Services;

use App\Models\Pictures;
use App\Models\Images;
use Illuminate\Support\Facades\Hash;

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
                'pictures.description',
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
     * @param int $id
     * 
     * @return App\Models\Pictures
     */
    public function getPictureById(int $id)
    {
        return $this->base()
            ->where('pictures.id', $id)
            ->first();
    }


    /**
     * Save picture.
     * 
     * @param array params(PicturesUploadRequest->validated)
     * 
     * @return void
     */
    public function save($params)
    {
        $lastRow = $this->base()
            ->orderBy('pictures.id', 'desc')
            ->limit(1)
            ->first();

        $id = sprintf('%06d', $lastRow->id + 1);
        $hash = base64_encode(substr(Hash::make($id), -27));
        $file = $params['image_file'];
        $extension = Images::getExtensions()[$file->getMimetype()];
        $fileName = sprintf('pictures/image-%s-%s.%s', $id, $hash, $extension);

        $pictures = new Pictures();
        $pictures->file = $fileName;
        $pictures->user_id = user()->id;
        $pictures->title = $params['title'];
        $pictures->description = $params['description'];
        $pictures->save();

        $file->storeAs('contents/images/', $fileName);
    }
}
