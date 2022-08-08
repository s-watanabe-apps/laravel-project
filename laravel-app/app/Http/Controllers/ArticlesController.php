<?php
namespace App\Http\Controllers;

use App\Models\Articles;
use App\Services\ArticleCommentsService;
use App\Services\ArticlesService;
use App\Services\UsersService;
use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
use App\Http\Requests\ArticlesRequest;
use App\Libs\Status;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // Instance variables.
    private $articleCommentsService;
    private $articlesService;
    private $usersService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\ArticleCommentsService
     * @param App\Services\ArticlesService
     * @param App\Services\UsersService
     * @return void
     */
    public function __construct(
        ArticleCommentsService $articleCommentsService,
        ArticlesService $articlesService,
        UsersService $usersService
    ) {
        $this->articleCommentsService = $articleCommentsService;
        $this->articlesService = $articlesService;
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
        $articlesUser = $this->usersService->getUsersById($request->user->id);
        if (!$articlesUser) {
            abort(404);
        }

        $articles = $this->articlesService->getByUserId($request->id, $request->user->id);

        $articleIds = array_column($articles->toArray()['data'], 'id');
        $commentCount = $this->articleCommentsService->getArticlesCommentCount($articleIds);

        $latestArticles = $this->articlesService->getLatestArticles($request->id, $request->user->id);

        return view('articles.user', compact('articles', 'articlesUser', 'commentCount', 'latestArticles'));
    }

    /**
     * Get article.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        try {
            $articles = $this->articlesService->getById($request->id, $request->user->id);

            $articleComments = $this->articleCommentsService->getByArticleId($articles->id);

            $latestArticles = $this->articlesService->getLatestArticles($articles->user_id, $request->user->id);
        } catch(NotFoundException $e) {
            abort(404);
        } catch(ForbiddenException $e) {
            abort(403);
        }

        return view('articles.view', compact('articles', 'articleComments', 'latestArticles'));
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
        try {
            $articles = $this->articlesService->getById($request->id, $request->user->id);
        } catch(NotFoundException $e) {
            abort(404);
        } catch(ForbiddenException $e) {
            abort(403);
        }

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

        $method = $request->method();

        return view('articles.confirm', compact('articles', 'method'));
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
            try {
                if (strcmp(strtolower($request->method()), Parent::REQUEST_METHOD_POST) == 0) {
                    $this->articlesService->saveMemberArticles($request->user->id, $request);
                } else if (strcmp(strtolower($request->method()), Parent::REQUEST_METHOD_PUT) == 0) {
                    $this->articlesService->editMemberArticles($request->user->id, $request);
                } else {
                    throw new NotFoundException();
                }
            } catch(NotFoundException $e) {
                abort(404);
            } catch(ForbiddenException $e) {
                abort(403);
            }
        });

        return redirect()->route('articles.user', ['id' => $request->user->id]);
    }
}
