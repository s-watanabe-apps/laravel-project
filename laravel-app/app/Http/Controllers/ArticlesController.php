<?php
namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Images;
use App\Http\Requests\AppRequest;
use App\Http\Requests\ArticlePostRequest;

class ArticlesController extends Controller
{
    /**
     * Write an article.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function write(AppRequest $request)
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
        \DB::transaction(function() use ($request) {
            Articles::saveArticles(
                $request->user->id,
                Articles::TYPE_MEMBER_ARTICLE,
                $request->validated());
        });

        exit;
    }

}
