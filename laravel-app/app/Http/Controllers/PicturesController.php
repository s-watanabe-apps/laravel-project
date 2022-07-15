<?php
namespace App\Http\Controllers;

use App\Models\PictureComments;
use App\Models\Pictures;
use Illuminate\Http\Request;

class PicturesController extends Controller
{
    /**
     * Get pictures images.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $images = Pictures::getPictureImages();

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
        $image = Pictures::getPictureImages($request->id);

        $isFavorite = $this->isFavorite($request);

        $pictureComments = PictureComments::getByPictureId($request->id);

        return view('pictures.get', compact(
            'image',
            'isFavorite',
            'pictureComments'
        ));
    }
}
