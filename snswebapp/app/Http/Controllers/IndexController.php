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
     * Get top page of site.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        //dump(auth()->check());
        //var_dump(\App\Services\Files::getRegex());

        //echo "<pre>";
        //var_dump(Auth::user()->name);
        //var_dump(Auth::user()->email);
        //var_dump($request->settings->site_name);
        //Mail::to("swata82@gmail.com")->send(new ContactMail("送信テスト", "test"));
        //var_dump(\Config::get('mail'));

        // Informations
        $informations = $this->informationsService->getEnabled();

        // Weekly calendar
        $calendar = $this->calendarService->getWeeklyCalendarEvents();

        // Latest Articles
        $articles = $this->articlesService->getLatestArticles();
        //dump($articles);

        return view('index', compact(
            'informations', 'calendar', 'articles'
        ));
    }
}
