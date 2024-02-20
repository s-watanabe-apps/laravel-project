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
     * Get top page of site.
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

        // Informations
        $informations = $this->informationsService->getEnabledInformations();

        // Weekly calendar
        $calendar = $this->calendarService->getWeeklyCalendarEvents();

        // Latest Articles
        $data = $this->articlesService->getLatestArticles();
        $data[0]['image_url'] = 'http://snswebapp.jp:8000/show/image?file=profiles%2Fno_image.png';

        // ページャー生成
        $limit = 10;
        $page = 1;
        $articles = new LengthAwarePaginator(
            array_slice($data, ($page - 1) * $limit, $limit),
            count($data),
            $limit,
            $page,
            ['path' => '/']
        );

        $feature_tags = [];

        return view('index', compact(
            'informations',
            'articles',
        ));
    }
}
