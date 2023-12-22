<?php
namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Labels;
use App\Services\ArticleLabelsService;
use App\Services\ArticleCommentsService;
use App\Services\ArticlesService;
use App\Services\LabelsService;
use App\Services\UsersService;
use App\Http\Exceptions\BusinessException;
use App\Http\Exceptions\ForbiddenException;
use App\Http\Requests\ArticlesRequest;
use App\Http\Requests\CommentRequest;
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
        return redirect()->route('articles.user', ['id' => user()->id]);
    }

    /**
     * Get side menu informations.
     * 
     * @param int $userId
     * @return array
     */
    private function getSidemenus(int $userId)
    {
        $archiveMonths = $this->articlesService->getArchiveMonths($userId);

        $latestArticles = $this->articlesService->getLatestArticlesByUserId($userId);

        $favoriteArticles = $this->articlesService->getFavoriteArticlesByUserId($userId);

        $userLabels = $this->articleLabelsService->getByUserId($userId);

        return compact(
            'archiveMonths',
            'latestArticles',
            'favoriteArticles',
            'userLabels'
        );
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
            'label' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            throw new BusinessException();
        }

        $labelId = null;
        $labelName = trim($validator->validated()['label'] ?? null);
        if (!is_null($labelName)) {
            $labels = $this->labelsService->getIdByName($labelName);
            $labelId = $labels->id ?? 0;
        }

        $articlesUser = $this->usersService->get($request->id);

        $articles = $this->articlesService->getByUserId($request->id, $labelId);

        $articleIds = array_column($articles->toArray()['data'], 'id');
        $commentCount = $this->articleCommentsService->getArticlesCommentCount($articleIds);

        $sidemenus = $this->getSidemenus($request->id);

        return view('articles.user', compact(
            'labelName',
            'articles',
            'articlesUser',
            'commentCount',
            'sidemenus'
        ));
    }

    /**
     * Get article.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $articles = $this->articlesService->get($request->id);

        $articleComments = $this->articleCommentsService->getByArticleId($articles->id);

        $labels = $this->articleLabelsService->getByArticleId($request->id);

        $sidemenus = $this->getSidemenus($articles->user_id);

        return view('articles.viewer', compact(
            'articles',
            'articleComments',
            'labels',
            'sidemenus'
        ));
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
        $articles = $this->articlesService->get($request->id);

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
        $articles->user_id = user()->id;

        $labels = $this->labelsService->stringToLabels($articles->labels ?? '');

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
            $values = $request->validated();
            unset($values['labels']);
            $this->articlesService->save($values);

            //$this->articleLabelsService->save($request);
        });

        return redirect()->route('articles.user', ['id' => user()->id]);
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
            $this->articleCommentsService->save(user()->id, $params);
        });

        return redirect()->route('articles.get', ['id' => $params['id']]);
    }

}
