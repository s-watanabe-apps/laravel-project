<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

class Images extends Model
{
    // Table name.
    public $table = 'images';

    // Model constants.
    const TYPE_PROFILE_IMAGE = 1;
    const TYPE_ARTICLE_IMAGE = 2;
    const TYPE_PICTURE_IMAGE = 3;

    const MIME_TYPE_PNG = 'image/png';
    const MIME_TYPE_JPG = 'image/jpeg';
    const MIME_TYPE_GIF = 'image/gif';

    // Multiple assignable attributes.
    protected $fillable = [
        'type',
        'target_id',
        'name',
    ];

    /**
     * Get image types.
     * 
     * @return [image_type(int) => image_type_name(string)]
     */
    public static function getTypes()
    {
        return [
            self::TYPE_PROFILE_IMAGE => 'プロフィール画像',
            self::TYPE_ARTICLE_IMAGE => '記事内の画像',
            self::TYPE_PICTURE_IMAGE => 'アルバムに投稿された画像',
        ];
    }

    /**
     * Get extensions.
     * 
     * @return [mime_type(string) => extensions(string)]
     */
    public static function getExtensions()
    {
        return [
            self::MIME_TYPE_PNG => 'png',
            self::MIME_TYPE_JPG => 'jpg',
            self::MIME_TYPE_GIF => 'gif',
        ];
    }
}