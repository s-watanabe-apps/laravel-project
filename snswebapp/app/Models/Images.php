<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

class Images extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'type',
        'target_id',
        'name',
    ];

    // イメージタイプ定数.
    const TYPE_PROFILE_IMAGE = 1;
    const TYPE_ARTICLE_IMAGE = 2;
    const TYPE_PICTURE_IMAGE = 3;

    // マインタイプ定数.
    const MIME_TYPE_PNG = 'image/png';
    const MIME_TYPE_JPG = 'image/jpeg';
    const MIME_TYPE_GIF = 'image/gif';

    // イメージタグ正規表現.
    const PATTERN_IMG = '/<img.*?src\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i';

    /**
     * イメージタイプ取得.
     *
     * @return array
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
     * 拡張子取得.
     *
     * @return array
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