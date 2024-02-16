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
     * コンストラクタ.
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
     * 自分の記事一覧取得.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return redirect()->route('articles.user', ['id' => user()->id]);
    }

    /**
     * ユーザーの記事一覧取得.
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

        $label_id = null;
        $label_name = trim($validator->validated()['label'] ?? null);
        if (!is_null($label_name)) {
            $labels = $this->labelsService->get_id_by_name($label_name);
            $label_id = $labels['id'] ?? 0;
        }

        $articles_user = $this->usersService->get($request->id);

/*
        $articlesUser = $this->usersService->get($request->id);

        $articles = $this->articlesService->getByUserId($request->id, $labelId);

        $articleIds = array_column($articles->toArray()['data'], 'id');
        $commentCount = $this->articleCommentsService->getArticlesCommentCount($articleIds);

        $sidemenus = $this->getSidemenus($request->id);
*/
        return view('articles.user', compact(
            'articles_user',
        ));
    }

    /**
     * 記事取得.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $articles = $this->articlesService->get($request->id);

        $articleComments = $this->articleCommentsService->getByArticleId($articles['id']);

        $labels = $this->articleLabelsService->getByArticleId($request->id);

        return view('articles.view', compact(
            'articles',
            'articleComments',
            'labels'
        ));
    }

    /**
     * 記事作成.
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
     * 入力内容確認.
     * 
     * @param App\Http\Requests\ArticlesRequest
     * @return Illuminate\View\View
     */
    public function createConfirm(ArticlesRequest $request)
    {
        $validated = $request->validated();

        $labels = $this->labelsService->str_to_labels($validated['labels'] ?? '');

        return view('articles.createConfirm', compact('validated', 'labels'));
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
