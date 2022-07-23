<?php
namespace App\Http\Controllers;

use App\Models\Articles;
use App\Services\ArticlesService;
use App\Http\Requests\ArticlesRequest;
use App\Libs\Status;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // Instance variables.
    private $articlesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\ArticlesService
     * @return void
     */
    public function __construct(
        ArticlesService $articlesService
    ) {
        $this->articlesService = $articlesService;
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

    public function user(Request $request)
    {
        $articles = $this->articlesService->getByUserId($request->id);

        return view('articles.user', compact('articles'));
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

        if (!$articles || $articles->status == Status::DISABLED) {
            abort(404);
        }

        return view('articles.viewer', compact('articles'));
    }

    /**
     * Write an article.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function write(Request $request)
    {
        return $this->postView('articles.editor');
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

        if (!$articles || $articles->user_id != $request->user->id) {
            abort(404);
        }

        return $this->putView('articles.editor', compact('articles'));
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

        return $this->customView('articles.viewer', compact('articles'), $request->method());
    }

    /**
     * Posting an article.
     * 
     * @param \App\Http\Requests\ArticlesRequest
     * @return void
     */
    public function register(ArticlesRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $this->articlesService->add(
                $request->validated() + [
                    'user_id' => $request->user->id,
                    'type' => Articles::TYPE_MEMBER_ARTICLE,
                    'status' => Status::ENABLED,
                ]
            );
        });

        exit;
    }

}
