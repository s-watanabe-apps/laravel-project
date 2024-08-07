<?php
namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Settings;
use App\Services\CalendarService;
use App\Services\InformationsService;
use App\Services\ArticlesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * インデックスコントローラ.
 *
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class IndexController extends Controller
{
    // サービス変数.
    private $informationsService;
    private $calendarService;
    private $articlesService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\InformationsService
     * @param App\Services\CalendarService
     * @return void
     */
    public function __construct(
        InformationsService $informationsService,
        CalendarService $calendarService,
        ArticlesService $articlesService
    ) {
        $this->informationsService = $informationsService;
        $this->calendarService = $calendarService;
        $this->articlesService = $articlesService;
    }

    /**
     * トップページ.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        //dump(user()->is_admin());
        //var_dump(\App\Services\Files::getRegex());

        //echo "<pre>";
        //var_dump(Auth::user()->name);
        //var_dump(Auth::user()->email);
        //var_dump($request->settings->site_name);
        //Mail::to("swata82@gmail.com")->send(new ContactMail("送信テスト", "test"));
        //var_dump(\Config::get('mail'));

        $validator = Validator::make([
            'date' => $request->date,
            'page' => $request->page,
        ], [
            'date' => 'date|nullable',
            'page' => 'integer|nullable',
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $validated = $validator->validated();

        $informations = $this->informationsService->getEnabledInformations();

        $calendar = $this->calendarService->getWeeklyCalendarEvents();

        $articles = $this->articlesService->getLatestArticles(carbon($validated['date']));
        $articles = $this->pager($articles, 10, $validated['page'], '/');

        $feature_tags = [];

        return view('index', compact(
            'informations',
            'articles',
        ));
    }
}
