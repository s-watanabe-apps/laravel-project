<?php
namespace App\Models;

class Favorites extends Model
{
    // Table name.
    public $table = 'favorites';

    // Model constants.
    const FAVORITE_CODE_PROFILES = 'profiles';
    const FAVORITE_CODE_PICTURES = 'pictures';

    /**
     * Get favorite names.
     * 
     * @return [string][string]
     */
    public static function getFavoriteNames()
    {
        return [
            self::FAVORITE_CODE_PROFILES => __('strings.profile'),
            self::FAVORITE_CODE_PICTURES => __('strings.pictures'),
        ];
    }
}
