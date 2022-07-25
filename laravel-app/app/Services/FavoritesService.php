<?php
namespace App\Services;

use App\Models\Favorites;
use Carbon\Carbon;

class FavoritesService
{
    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Favorites::query()
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
                    ->where('users.status', Status::ENABLED);
            })->unionAll(
                Favorites::query()
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
                            ->where('users.status', Status::ENABLED);
                    })
            );
    }

    /**
     * Is favorite.
     * 
     * @param Illuminate\Http\Request $request
     * @return boolean
     */
    public function isFavorite($request)
    {
        return $this->getFaivoritesByUserIdAndRequest($request->user->id, $request->path()) != null ? 1 : 0;
    }

    /**
     * Get favorites by user id and request.
     * 
     * @param int $userId
     * @param int $path
     * @return App\Models\Favorites
     */
    public function getFaivoritesByUserIdAndRequest($userId, $path)
    {
        return $this->query()
            ->where('user_id', $userId)
            ->where('uri', '/' . $path)
            ->get()->first();
    }

    /**
     * Get favorite name.
     * 
     * @param string $favoriteCode
     * @return string
     */
    public function getFavoriteName($favoriteCode)
    {
        $favoriteNames = Favorites::getFavoriteNames();
        if (array_key_exists($favoriteCode, $favoriteNames)) {
            return $favoriteNames[$favoriteCode];
        }
        return null;
    }

    /**
     * Get favorites by user id.
     * 
     * @param int $userId
     * @return App\Models\Favorites
     */
    public function getFavoritesByUserId($userId)
    {
        $result = $this->query()->get();

        foreach ($result as &$value) {
            $value->favorite_name = $this->getFavoriteName($value->favorite_code);
        }

        return $result;
    }

    /**
     * Add favorites.
     * 
     * @var int $userId
     * @var string $favoriteUri
     */
    public function add($userId, $uri)
    {
        list($favoriteCode, $favoriteId) = $this->decomposeUri($uri);

        $favorites = new Favorites();
        $favorites->user_id = $userId;
        $favorites->uri = $uri;
        $favorites->favorite_code = $favoriteCode;
        $favorites->favorite_id = $favoriteId;
        return $favorites->save();
    }

    /**
     * Remove favorites.
     * 
     * @param int $userId
     * @param string $uri
     */
    public function remove($userId, $uri)
    {
        return $this->query()
            ->where('user_id', $userId)
            ->where('uri', $uri)
            ->delete();
    }

    /**
     * Decompose the URI.
     * 
     * @var string $uri
     * @return [string, string]
     */
    private function decomposeUri($uri)
    {
        $favoriteCodes = implode('|', array_keys(Favorites::getFavoriteNames()));
        $pattern = sprintf('/^\/(%s)\/([0-9]{1,})$/', $favoriteCodes);
        \Log::info($pattern);
        preg_match($pattern, $uri, $matchs);
        return [$matchs[1], $matchs[2]];
    }
}
