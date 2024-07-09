<?php
namespace App\Models;

class Favorites extends Model
{
    protected $table = 'favorites';
    public $timestamps = true;

    // お気に入りコード定数.
    const FAVORITE_CODE_PROFILES = 'profiles';
    const FAVORITE_CODE_PICTURES = 'pictures';

    /**
     * お気に入りコード取得.
     *
     * @return array
     */
    public static function getFavoriteNames()
    {
        return [
            self::FAVORITE_CODE_PROFILES => __('strings.profile'),
            self::FAVORITE_CODE_PICTURES => __('strings.pictures'),
        ];
    }
}
