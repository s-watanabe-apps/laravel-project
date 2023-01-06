<?php
namespace App\Services;

use App\Models\Images;

class ImagesService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Images::query()
            ->select([
                'images.id',
                'images.enabled',
                'images.type',
                'images.target_id',
                'images.name',
                'images.created_at',
                'images.updated_at',
                'images.deleted_at',
            ]);
    }

    /**
     * Get by id.
     * 
     * @param int $id
     * @return App\Models\Images
     */
    public function getById(int $id)
    {
        return $this->base()
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->orderByRaw('created_at desc')
            ->get()->first();
    }

    /**
     * Get by type and target_id.
     * 
     * @param int $type
     * @param int $targetId
     * @return App\Models\Images
     */
    public function getByTargetIdAndType(int $type, int $targetId)
    {
        return $this->base
            ->where('id', $id)
            ->wnere('target_id', $targetId)
            ->whereNull('deleted_at')
            ->orderByRaw('created_at desc')
            ->get()->first();
    }

    /**
     * Get name by id.
     * 
     * @var int $id
     * @return string images.name
     */
    public function getNameById(int $id)
    {
        $result = $this->getById($id);
        if (is_null($result)) {
            return null;
        } else {
            return $result->name;
        }
    }

    /**
     * Disable record.
     * 
     * @var int $id
     * @return bool result
     */
    public function disableById(int $id)
    {
        return $this->base()->where('id', $id)->delete();
    }

    /**
     * Save images.
     * 
     * @var int images.id
     * @var Object Image Data
     * @var int images.type
     * @var int images.target_id
     * @var int image index
     * @return App\Models\Images
     */
    public function saveImages($id, $file, $type, $targetId, $index = null)
    {
        if ($type == self::TYPE_PROFILE_IMAGE) {
            $fileName = $this->saveProfileImageFile($file, $targetId);
        } else if ($type == self::TYPE_ARTICLE_IMAGE) {
            $fileName = $this->saveArticleImageFile($file, $targetId, $index);
        } else {
            return;
        }

        if ($id == null) {
            $image = new Images();
        } else {
            $image = $this->getById($id);
        }

        $image->type = $type;
        $image->target_id = $targetId;
        $image->name = $fileName;
        $image->updated_at = carbon();
        $image->save();

        return $image;
    }

    /**
     * Save profile image.
     * 
     * @var Illuminate\Http\UploadedFile $file
     * @var int $userId
     * @return String
     */
    public function saveProfileImageFile($file, $userId)
    {
        $extension = self::getExtensions()[$file->getMimetype()];
        $fileName = 'profiles/' . $userId . '.' . $extension;
        $file->storeAs('contents/images/', $fileName);

        return urlencode($fileName);
    }

    /**
     * Save article image.
     * 
     * @var string Image base64 data
     * @var int articles.id
     * @var int articles index
     * @return string
     */
    public function saveArticleImageFile($file, $articleId, $index)
    {
        $data = base64_decode($file);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $data);

        $fileName = sprintf("articles/%s-%s.%s", $articleId, $index, self::getExtensions()[$mimeType]);

        $images = new Images();
        $images->enabled = true;
        $images->type = Images::TYPE_ARTICLE_IMAGE;
        $images->target_id = $articleId;
        $images->name = urlencode($fileName);
        $images->save();

        $storagePath = storage_path('app/contents/images/');
        $filePath =  $storagePath . $fileName;
        file_put_contents($filePath, $data);

        return urlencode($fileName);
    }

    public function getPictureImages()
    {
        return $this->base()
            ->where('images.type', self::TYPE_PICTURE_IMAGE)
            ->orderBy('images.created_at', 'desc')
            ->get()->toArray();
    }

}
