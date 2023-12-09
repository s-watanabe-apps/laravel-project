<?php
namespace App\Http\Controllers;

use App\Services\FavoritesService;
use App\Services\PicturesService;
use App\Services\PictureCommentsService;
use App\Services\UsersService;
use App\Http\Requests\PicturesUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PicturesController extends Controller
{
    // Instance variables.
    private $picturesService;
    private $pictureCommentsService;
    private $favoritesService;
    private $usersService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\PicturesService
     * @param App\Services\PictureCommentsService
     * @param App\Services\FavoritesService
     * @return void
     */
    public function __construct(
        PicturesService $picturesService,
        PictureCommentsService $pictureCommentsService,
        FavoritesService $favoritesService,
        UsersService $usersService
    ) {
        $this->picturesService = $picturesService;
        $this->pictureCommentsService = $pictureCommentsService;
        $this->favoritesService = $favoritesService;
        $this->usersService = $usersService;
    }


    /**
     * Get pictures images.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = Validator::make([
            'keyword' => $request->keyword,
            'user_id' => $request->user_id
        ], [
            'keyword' => 'string|nullable',
            'user_id' => 'integer|nullable|min:0',
        ]);
        if ($validator->fails()) {
            abort(422);
        }

        $validated = $validator->validated();

        $images = $this->picturesService->getPictures($validated['keyword'], $validated['user_id']);

        $users = $this->usersService->getEnabledUsers();

        return view('pictures.index', compact(
            'images',
            'users',
            'validated'
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

        $pictureComments = $this->pictureCommentsService->getByPictureId($request->id);

        return view('pictures.viewer', compact(
            'image',
            'isFavorite',
            'pictureComments'
        ));
    }

    public function upload(Request $request)
    {
        return view('pictures.upload');
    }

    public function post(PicturesUploadRequest $request)
    {
        dump($request->validated());
        exit;
    }
}
