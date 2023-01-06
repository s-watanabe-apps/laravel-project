<?php
namespace App\Services;

use App\Models\Favorites;
use Illuminate\Http\Request;

class FavoritesService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
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
                    ->where('favorites.favorite_code', Favorites::FAVORITE_CODE_PROFILES)
                    ->where('users.status', \Status::ENABLED);
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
                            ->where('favorites.favorite_code', Favorites::FAVORITE_CODE_PICTURES)
                            ->whereNull('pictures.deleted_at');
                    })->leftJoin('users', function ($join) {
                        $join->on('users.id', '=', 'pictures.user_id')
                            ->where('users.status', \Status::ENABLED);
                    })
            );
    }

    /**
     * Is favorite.
     * 
     * @param Illuminate\Http\Request $request
     * @return boolean
     */
    public function isFavorite(Request $request)
    {
        return $this->getFaivoritesByUserIdAndRequest(user()->id, $request->path()) != null ? 1 : 0;
    }

    /**
     * Get favorites by user id and request.
     * 
     * @param int $userId
     * @param string $path
     * @return App\Models\Favorites
     */
    public function getFaivoritesByUserIdAndRequest(int $userId, string $path)
    {
        return $this->base()
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
    public function getFavoriteName(string $favoriteCode)
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
    public function getFavoritesByUserId(int $userId)
    {
        $result = $this->base()->get();

        foreach ($result as &$value) {
            $value->favorite_name = $this->getFavoriteName($value->favorite_code);
        }

        return $result;
    }

    /**
     * Add favorites.
     * 
     * @var int $userId
     * @var string $uri
     */
    public function add(int $userId, string $uri)
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
    public function remove(int $userId, string $uri)
    {
        return $this->base()
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
    private function decomposeUri(string $uri)
    {
        $favoriteCodes = implode('|', array_keys(Favorites::getFavoriteNames()));
        $pattern = sprintf('/^\/(%s)\/([0-9]{1,})$/', $favoriteCodes);
        preg_match($pattern, $uri, $matchs);

        return [$matchs[1], $matchs[2]];
    }
}
