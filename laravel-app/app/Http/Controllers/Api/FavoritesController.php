<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorites;
use App\Http\Requests\ApiFavoritesPostRequest;

class FavoritesController extends ApiController
{
    /**
     * Switch favorites.
     * 
     * @param  App\Http\Requests\ApiFavoritesPostRequest
     * @return Illuminate\Http\JsonResponse
     */
    public function post(ApiFavoritesPostRequest $request)
    {
        \Log::info("test");

        if (!$request->isFavorite) {
            Favorites::addFavorites($this->user->id, $request->uri);

            $result = [
                'message' => __('strings.operation_messages.add_favorites'),
            ];
        } else {
            Favorites::removeFavorites($this->user->id, $request->uri);

            $result = [
                'message' => __('strings.operation_messages.remove_favorites'),
            ];
        }
        
        return response()->json($result);
    }
}
