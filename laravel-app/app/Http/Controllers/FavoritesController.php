<?php
namespace App\Http\Controllers;

use App\Services\FavoritesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoritesController extends Controller
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
     * Get favorite list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $favorites = $this->favoritesService->getFavoritesByUserId(user()->id);

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

        $this->favoritesServices->remove(user()->id, $validated['uri']);

        return redirect()->route('favorites');
    }
}
