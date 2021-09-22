<?php
namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Images;
use App\Http\Requests\ArticlePostRequest;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('authcheck');
    }

    /**
     * Write an article.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function write(Request $request)
    {
        return view('articles.write');
    }

    /**
     * Confirmation of the written article.
     * 
     * @param  \App\Http\Requests\ArticlePostRequest
     * @return \Illuminate\View\View
     */
    public function confirm(ArticlePostRequest $request)
    {
        $validated = $request->validated();

        return view('articles.confirm', compact('validated'));
    }

    /**
     * Posting an article.
     * 
     * @param  \App\Http\Requests\ArticlePostRequest
     * @return void
     */
    public function post(ArticlePostRequest $request)
    {
        \DB::beginTransaction();
        try {
            Articles::saveArticles(
                $request->user->id,
                Articles::TYPE_MEMBER_ARTICLE,
                $request->validated());

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e->getMessage());
            abort(500);
        }

        exit;
    }

}
