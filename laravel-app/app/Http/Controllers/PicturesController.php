<?php
namespace App\Http\Controllers;

use App\Models\PictureComments;
use App\Services\FavoritesService;
use App\Services\PicturesService;
use Illuminate\Http\Request;

class PicturesController extends Controller
{
    // Instance variables.
    private $picturesService;
    private $favoritesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\PicturesService
     * @param App\Services\FavoritesService
     * @return void
     */
    public function __construct(
        PicturesService $picturesService,
        FavoritesService $favoritesService
    ) {
        $this->picturesService = $picturesService;
        $this->favoritesService = $favoritesService;
    }


    /**
     * Get pictures images.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $images = $this->picturesService->getPictures();

        return view('pictures.index', compact(
            'images'
        ));
    }

    /**
     * Get picture.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $image = $this->picturesService->getPictureById($request->id);

        $isFavorite = $this->favoritesService->isFavorite($request);
var_dump($isFavorite);

        $pictureComments = PictureComments::getByPictureId($request->id);

        return view('pictures.get', compact(
            'image',
            'isFavorite',
            'pictureComments'
        ));
    }
}
