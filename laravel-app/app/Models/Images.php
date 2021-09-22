<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent;
use Illuminate\Notifications\Notifiable;

class Images extends Eloquent\Model
{
    const TYPE_PROFILE_IMAGE = 1;
    const TYPE_ARTICLE_IMAGE = 2;
    const TYPE_PICTURE_IMAGE = 3;

    public static function getTypes()
    {
        return [
            self::TYPE_PROFILE_IMAGE => 'プロフィール画像',
            self::TYPE_ARTICLE_IMAGE => '記事内の画像',
            self::TYPE_PICTURE_IMAGE => 'アルバムに投稿された画像',
        ];
    }

    const MIME_TYPE_PNG = 'image/png';
    const MIME_TYPE_JPG = 'image/jpeg';
    const MIME_TYPE_GIF = 'image/gif';

    public static function getExtensions()
    {
        return [
            self::MIME_TYPE_PNG => 'png',
            self::MIME_TYPE_JPG => 'jpg',
            self::MIME_TYPE_GIF => 'gif',
        ];
    }

    use Notifiable;

    protected $table = 'images';

    protected $fillable = [
        'type',
        'target_id',
        'name',
    ];

    /**
     * Get by id.
     * 
     * @var int images.id
     * @return App\Models\Images
     */
    public static function getById($id)
    {
        return self::query()
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->orderByRaw('created_at desc')
            ->get()->first();
    }

    /**
     * Get by type and target_id.
     * 
     * @var int images.id
     * @return App\Models\Images
     */
    public static function getByTargetIdAndType($type, $targetId)
    {
        return self::query()
            ->where('id', $id)
            ->wnere('target_id', $targetId)
            ->whereNull('deleted_at')
            ->orderByRaw('created_at desc')
            ->get()->first();
    }

    /**
     * Get name by id.
     * 
     * @var int images.id
     * @return string images.name
     */
    public static function getNameById($id)
    {
        $result = self::getById($id);
        if (is_null($result)) {
            return null;
        } else {
            return $result->name;
        }
    }

    /**
     * Disable record.
     * 
     * @var int images.id
     * @return bool result
     */
    public static function disableById($id)
    {
        return self::where('id', $id)
            ->update(['deleted_at' => new Carbon()]);
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
    public static function saveImages($id, $file, $type, $targetId, $index = null)
    {
        if ($type == self::TYPE_PROFILE_IMAGE) {
            $fileName = self::saveProfileImageFile($file, $targetId);
        } else if ($type == self::TYPE_ARTICLE_IMAGE) {
            $fileName = self::saveArticleImageFile($file, $targetId, $index);
        } else {
            return;
        }

        if ($id == null) {
            $image = new Images();
        } else {
            $image = self::getById($id);
        }

        $image->type = $type;
        $image->target_id = $targetId;
        $image->name = $fileName;
        $image->updated_at = new Carbon();
        $image->save();

        return $image;
    }

    /**
     * Save profile image.
     * 
     * @var Illuminate\Http\UploadedFile
     * @var int
     * @return String
     */
    public static function saveProfileImageFile($file, $userId)
    {
        $extension = self::getExtensions()[$file->getMimetype()];
        $fileName = "profiles/" . $userId . '.' . $extension;
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
    public static function saveArticleImageFile($file, $articleId, $index)
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

    public static function getPictureImages()
    {
        return self::query()->select([
                'images.id',
                'images.enabled',
                'images.type',
                'images.target_id',
                'images.name',
                'images.created_at',
                'images.updated_at',
                'images.deleted_at',
            ])
            ->where('images.type', self::TYPE_PICTURE_IMAGE)
            ->orderBy('images.created_at', 'desc')
            ->get()->toArray();
    }
}