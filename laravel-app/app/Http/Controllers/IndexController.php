<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Informations;
use App\Models\Users;
use App\Models\Settings;
use App\Services\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{

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
        $informations = Informations::getEnabled();

        // Weekly calendar
        $calendar = Calendar::getWeeklyCalendar();

        // Latest Articles
        

        return view('index', compact(
            'informations', 'calendar'
        ));
    }
}
