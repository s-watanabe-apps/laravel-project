<?php
namespace App\Http\Controllers;

use App\Models\Articles;
use App\Services\ArticlesService;
use App\Http\Requests\ArticlesRequest;
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
     * Confirmation of the written article.
     * 
     * @param App\Http\Requests\ArticlesRequest
     * @return Illuminate\View\View
     */
    public function confirm(ArticlesRequest $request)
    {
        $validated = $request->validated();

        $formMethod = $request->method();

        return view('articles.viewer', compact(
            'validated', 'formMethod'
        ));
    }

    /**
     * Posting an article.
     * 
     * @param  \App\Http\Requests\ArticlesRequest
     * @return void
     */
    public function post(ArticlesRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $this->articlesService->save(
                $request->user->id,
                Articles::TYPE_MEMBER_ARTICLE,
                $request->validated());
        });

        exit;
    }

}
