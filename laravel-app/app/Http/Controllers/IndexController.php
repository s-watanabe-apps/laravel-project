<?php
namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Settings;
use App\Services\CalendarService;
use App\Services\InformationsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    // Instance variables.
    private $informationsService;
    private $calendarService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\InformationsService
     * @param App\Services\CalendarService
     * @return void
     */
    public function __construct(
        InformationsService $informationsService,
        CalendarService $calendarService
    ) {
        $this->informationsService = $informationsService;
        $this->calendarService = $calendarService;
    }

    /**
     * Get top page of site.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        
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
        $calendar = $this->calendarService->getWeeklyCalendar();

        // Latest Articles
        

        return view('index', compact(
            'informations', 'calendar'
        ));
    }
}
