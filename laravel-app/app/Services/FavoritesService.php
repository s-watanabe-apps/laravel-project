<?php
namespace App\Services;

use App\Models\Favorites;
use Carbon\Carbon;

class FavoritesService
{
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
        return Favorites::query()
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
        $result = Favorites::query()->get();

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
        return Favorites::query()
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
