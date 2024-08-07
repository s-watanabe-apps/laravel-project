<?php
namespace App\Http\Controllers;

use App\Services\FavoritesService;
use App\Services\PicturesService;
use App\Services\PictureCommentsService;
use App\Services\UsersService;
use App\Http\Requests\PicturesUploadRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * アルバムコントローラ.
 * 
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class PicturesController extends Controller
{
    // サービス変数.
    private $picturesService;
    private $pictureCommentsService;
    private $favoritesService;
    private $usersService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\PicturesService
     * @param App\Services\PictureCommentsService
     * @param App\Services\FavoritesService
     * @param App\Services\UsersService
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
     * 写真一覧.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = Validator::make([
            'keyword' => $request->keyword,
            'user_id' => $request->user_id,
            'page' => $request->page,
        ], [
            'keyword' => 'string|nullable',
            'user_id' => 'integer|nullable|min:0',
            'page' => 'integer|nullable',
        ]);
        if ($validator->fails()) {
            abort(422);
        }

        $validated = $validator->validated();

        $pictures = $this->picturesService->getPictures($validated['keyword'], $validated['user_id']);
        $pictures = $this->pager($pictures, 12, $validated['page'], '/album/');

        //$users = $this->usersService->getEnabledUsers(null, null, false);

        return view('pictures.index', compact(
            'pictures',
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

    /**
     * Upload picture forms.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function upload(Request $request)
    {
        return view('pictures.upload');
    }

    /**
     * Post picture.
     * 
     * @param App\Http\Requests\PicturesUploadRequest
     */
    public function post(PicturesUploadRequest $request)
    {
        $params = $request->validated();
        
        \DB::transaction(function() use ($params) {
            $this->picturesService->save($params);
        });

        return redirect()->route('pictures.index');
    }

    /**
     * Post picture comment.
     * 
     * @param App\Http\Requests\CommentRequest
     */
    public function comment(CommentRequest $request)
    {
        $params = $request->validated();
        
        \DB::transaction(function() use ($params) {
            $this->pictureCommentsService->save(user()->id, $params);
        });

        return redirect()->route('pictures.get', ['id' => $params['id']]);
    }

    /**
     * Get picture view and edit comment view.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function editComment(Request $request)
    {
        $image = $this->picturesService->getPictureById($request->id);

        $isFavorite = $this->favoritesService->isFavorite($request);

        $pictureComments = $this->pictureCommentsService->getByPictureId($request->id);

        $editComment = (object) $this->pictureCommentsService->getEditComment($pictureComments, user()->id, $request->comment_id)[0];

        return view('pictures.viewer', compact(
            'image',
            'isFavorite',
            'pictureComments',
            'editComment'
        ));
    }
}
