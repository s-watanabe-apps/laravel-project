<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoritesController extends Controller
{
    /**
     * Get favorite list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $favorites = Favorites::getFavoritesByUserId($request->user->id);

        return view('favorites.index', compact(
            'favorites'
        ));
    }

    /**
     * Remove favorites from the list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function remove(Request $request)
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
