<?php
namespace App\Services;

use App\Models\Pictures;
use App\Models\Images;
use Illuminate\Support\Facades\Hash;

/**
 * 写真サービスクラス.
 * 
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class PicturesService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Pictures::query()->select([
                'pictures.*',
                'users.name',
            ])
            ->whereNull('pictures.deleted_at')
            ->leftJoin('users', 'pictures.user_id', '=', 'users.id');
    }

    /**
     * 写真一覧取得.
     * 
     * @param string keyword
     * @param int user_id
     * @return array
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
            ->get()
            ->toArray();
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
