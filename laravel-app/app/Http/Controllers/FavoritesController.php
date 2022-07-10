<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Http\Requests\AppRequest;
use Illuminate\Support\Facades\Validator;

class FavoritesController extends Controller
{
    /**
     * index Get.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function index(AppRequest $request)
    {
        $favorites = Favorites::getFavoritesByUserId($request->user->id);

        return view('favorites.index', compact(
            'favorites'
        ));
    }

    public function remove(AppRequest $request)
    {
        $validator = Validator::make([
            'uri' => $request->uri,
        ], [
            'uri' => ['required', 'regex:/^\/[a-z]*\/[0-9]*$/'],
        ]);
        if ($validator->fails()) {
            abort(400);
        }

        $validated = $validator->validated();

        Favorites::removeFavorites($request->user->id, $validated['uri']);

        return redirect()->route('favorites');
    }
}
