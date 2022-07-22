<?php
namespace App\Models;

class Favorites extends Model
{
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

    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function query()
    {
        return parent::query()
            ->select([
                'favorites.user_id',
                'favorites.uri',
                'favorites.favorite_code',
                'favorites.favorite_id',
                'favorites.created_at',
                'users.name',
                \DB::raw('null as value'),
            ])->join('users', function ($join) {
                $join->on('users.id', '=', 'favorites.favorite_id')
                    ->where('favorites.favorite_code', self::FAVORITE_CODE_PROFILES)
                    ->where('users.enable', 1);
            })->unionAll(
                parent::query()
                    ->select([
                        'favorites.user_id',
                        'favorites.uri',
                        'favorites.favorite_code',
                        'favorites.favorite_id',
                        'favorites.created_at',
                        'users.name',
                        \DB::raw('pictures.title as value'),
                    ])->join('pictures', function ($join) {
                        $join->on('pictures.id', '=', 'favorites.favorite_id')
                            ->where('favorites.favorite_code', self::FAVORITE_CODE_PICTURES)
                            ->whereNull('pictures.deleted_at');
                    })->leftJoin('users', function ($join) {
                        $join->on('users.id', '=', 'pictures.user_id')
                            ->where('users.enable', 1);
                    })
            );
    }
}
