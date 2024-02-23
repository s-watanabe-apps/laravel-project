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

class IndexController extends Controller
{
    // Instance variables.
    private $informationsService;
    private $calendarService;
    private $articlesService;

    /**
     * Create a new controller instance.
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
        dump($validated);

        $informations = $this->informationsService->getEnabledInformations();

        $calendar = $this->calendarService->getWeeklyCalendarEvents();

        $page = $validated['page'] ?? 1;
        $articles = $this->articlesService->getLatestArticles();
        $articles[0]['image_url'] = 'http://snswebapp.jp:8000/show/image?file=profiles%2Fno_image.png';
        $articles = $this->pager($articles, 10, $page, '/');


        $feature_tags = [];

        return view('index', compact(
            'informations',
            'articles',
        ));
    }
}
