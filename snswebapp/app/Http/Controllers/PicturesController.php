<?php
namespace App\Http\Controllers;

use App\Services\FavoritesService;
use App\Services\PicturesService;
use App\Services\PictureCommentsSetvice;
use Illuminate\Http\Request;

class PicturesController extends Controller
{
    // Instance variables.
    private $picturesService;
    private $pictureCommentsServices;
    private $favoritesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\PicturesService
     * @param App\Services\PictureCommentsServices
     * @param App\Services\FavoritesService
     * @return void
     */
    public function __construct(
        PicturesService $picturesService,
        PictureCommentsServices $pictureCommentsServices,
        FavoritesService $favoritesService
    ) {
        $this->picturesService = $picturesService;
        $this->pictureCommentsServices = $pictureCommentsServices;
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

        $pictureComments = $this->pictureCommentsServices->getByPictureId($request->id);

        return view('pictures.get', compact(
            'image',
            'isFavorite',
            'pictureComments'
        ));
    }
}
