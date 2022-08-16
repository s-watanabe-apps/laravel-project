<?php
namespace App\Http\Controllers;

use App\Models\Articles;
use App\Services\ArticleLabelsService;
use App\Services\ArticleCommentsService;
use App\Services\ArticlesService;
use App\Services\LabelsService;
use App\Services\UsersService;
use App\Http\Exceptions\BusinessException;
use App\Http\Exceptions\ForbiddenException;
use App\Http\Requests\ArticlesRequest;
use App\Libs\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    // Instance variables.
    private $articleCommentsService;
    private $articleLabelsService;
    private $articlesService;
    private $labelsService;
    private $usersService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\ArticleCommentsService
     * @param App\Services\ArticleLabelsService
     * @param App\Services\ArticlesService
     * @param App\Services\UsersService
     * @return void
     */
    public function __construct(
        ArticleCommentsService $articleCommentsService,
        ArticleLabelsService $articleLabelsService,
        ArticlesService $articlesService,
        LabelsService $labelsService,
        UsersService $usersService
    ) {
        $this->articleCommentsService = $articleCommentsService;
        $this->articleLabelsService = $articleLabelsService;
        $this->articlesService = $articlesService;
        $this->labelsService = $labelsService;
        $this->usersService = $usersService;
    }

    /**
     * Get my articles.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return redirect()->route('articles.user', ['id' => $request->user->id]);
    }

    /**
     * Get user articles.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'numeric',
        ]);

        if ($validator->fails()) {
            throw new BusinessException();
        }

        $labelId = $validator->validated()['label'] ?? null;

        $searchLabels = null;
        if (!is_null($labelId)) {
            $searchLabels = $this->labelsService->getById($labelId);
        }
        
        $articlesUser = $this->usersService->getUsersById($request->id);

        $articles = $this->articlesService->getByUserId($request->id, $request->user->id, $labelId);

        $articleIds = array_column($articles->toArray()['data'], 'id');
        $commentCount = $this->articleCommentsService->getArticlesCommentCount($articleIds);

        $latestArticles = $this->articlesService->getLatestArticles($request->id, $request->user->id);

        $favoriteArticles = $this->articlesService->getFavoriteArticles($request->id);

        $userLabels = $this->articleLabelsService->getByUserId($request->id);

        return view('articles.user', compact(
            'searchLabels', 'articles', 'articlesUser', 'commentCount', 'latestArticles', 'favoriteArticles', 'userLabels'));
    }

    /**
     * Get article.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $articles = $this->articlesService->getById($request->id, $request->user->id);

        $articleComments = $this->articleCommentsService->getByArticleId($articles->id);

        $latestArticles = $this->articlesService->getLatestArticles($articles->user_id, $request->user->id);

        $favoriteArticles = $this->articlesService->getFavoriteArticles($request->id);

        $labels = $this->articleLabelsService->getByArticleId($request->id);

        $userLabels = $this->articleLabelsService->getByUserId($articles->user_id);

        return view('articles.view', compact('articles', 'articleComments', 'latestArticles', 'favoriteArticles', 'labels', 'userLabels'));
    }

    /**
     * Write an article.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function write(Request $request)
    {
        return view('articles.create');
    }

    /**
     * Edit an article.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $articles = $this->articlesService->getById($request->id, $request->user->id);

        return view('articles.edit', compact('articles'));
    }

    /**
     * Confirmation of the written article.
     * 
     * @param App\Http\Requests\ArticlesRequest
     * @return Illuminate\View\View
     */
    public function confirm(ArticlesRequest $request)
    {
        $articles = (new Articles())->bind($request->validated());

        $labels = [];

        $method = $request->method();

        return view('articles.confirm', compact('articles', 'labels', 'method'));
    }

    /**
     * Posting an article.
     * 
     * @param App\Http\Requests\ArticlesRequest
     * @return void
     */
    public function register(ArticlesRequest $request)
    {
        \DB::transaction(function() use ($request) {
            if ($request->isPost()) {
                $this->articlesService->saveMemberArticles($request);
            } else if ($request->isPut()) {
                $this->articlesService->editMemberArticles($request);
            } else {
                throw new NotFoundException();
            }
        });

        return redirect()->route('articles.user', ['id' => $request->user->id]);
    }
}
