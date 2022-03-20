<?php

namespace App\Models;

class Favorites extends Model
{
    protected $table = 'favorites';

    const FAVORITE_CODE_PROFILES = 'profiles';
    const FAVORITE_CODE_PICTURES = 'pictures';

    public static function getFavoriteNames()
    {
        return [
            self::FAVORITE_CODE_PROFILES => __('strings.profile'),
            self::FAVORITE_CODE_PICTURES => __('strings.pictures'),
        ];
    }

    public static function getFavoriteName($favoriteCode)
    {
        $favoriteNames = self::getFavoriteNames();
        if (array_key_exists($favoriteCode, $favoriteNames)) {
            return $favoriteNames[$favoriteCode];
        }
        return null;
    }

    public static function getFavoritesByUserId($userId)
    {
        return self::query()
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
            })->where('favorites.user_id', $userId)
            ->unionAll(
                self::query()
                    ->select([
                        'favorites.user_id',
                        'favorites.uri',
                        'favorites.favorite_code',
                        'favorites.favorite_id',
                        'favorites.created_at',
                        'users.name',
                        \DB::raw('pictures.title as name'),
                    ])->join('pictures', function ($join) {
                        $join->on('pictures.id', '=', 'favorites.favorite_id')
                            ->where('favorites.favorite_code', self::FAVORITE_CODE_PICTURES)
                            ->whereNull('pictures.deleted_at');
                    })->leftJoin('users', function ($join) {
                        $join->on('users.id', '=', 'pictures.user_id')
                            ->where('users.enable', 1);
                    })->where('favorites.user_id', $userId)
            )
            ->get();
    }

    public static function getFaivoritesByUserIdAndRequest($userId, $request)
    {
        return self::query()
            ->where('user_id', $userId)
            ->where('uri', '/' . $request->path())
            ->get()->first();
    }

    /**
     * Add favorites.
     * 
     * @var int $userId
     * @var string $favoriteUri
     */
    public static function addFavorites($userId, $uri)
    {
        list($favoriteCode, $favoriteId) = self::decomposeUri($uri);

        $favorites = new Favorites();
        $favorites->user_id = $userId;
        $favorites->uri = $uri;
        $favorites->favorite_code = $favoriteCode;
        $favorites->favorite_id = $favoriteId;
        return $favorites->save();
    }

    public static function removeFavorites($userId, $uri)
    {
        return self::query()
            ->where('user_id', $userId)
            ->where('uri', $uri)
            ->delete();
    }

    /**
     * Decompose the URI.
     * 
     * @var string $uri
     */
    private static function decomposeUri($uri)
    {
        $favoriteCodes = implode('|', array_keys(self::getFavoriteNames()));
        $pattern = sprintf('/^\/(%s)\/([0-9]{1,})$/', $favoriteCodes);
        \Log::info($pattern);
        preg_match($pattern, $uri, $matchs);
        return [$matchs[1], $matchs[2]];
    }
}
