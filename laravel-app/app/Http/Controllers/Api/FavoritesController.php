<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ApiFavoritesPostRequest;
use App\Services\FavoritesService;

class FavoritesController extends ApiController
{
    // Instance variables.
    private $favoritesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\FavoritesService
     * @return void
     */
    public function __construct(
        FavoritesService $favoritesService
    ) {
        $this->favoritesService = $favoritesService;
    }

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
            $this->favoritesService->add($this->user->id, $request->uri);

            $result = [
                'message' => __('strings.operation_messages.add_favorites'),
            ];
        } else {
            $this->favoritesService->remove($this->user->id, $request->uri);

            $result = [
                'message' => __('strings.operation_messages.remove_favorites'),
            ];
        }
        
        return response()->json($result);
    }
}
