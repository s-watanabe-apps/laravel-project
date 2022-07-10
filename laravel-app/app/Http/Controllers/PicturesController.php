<?php
namespace App\Http\Controllers;

use App\Models\PictureComments;
use App\Models\Pictures;
use App\Http\Requests\AppRequest;

class PicturesController extends Controller
{
    /**
     * Get pictures images.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function index(AppRequest $request)
    {
        $images = Pictures::getPictureImages();

        return view('pictures.index', compact(
            'images'
        ));
    }

    public function get(AppRequest $request)
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
