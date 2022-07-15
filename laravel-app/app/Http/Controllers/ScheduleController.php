<?php

namespace App\Http\Controllers;

use App\Services\Calendar;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Get schedule.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $events = Calendar::getMonthlyCalendar();

        return view('schedule.index', [
            'events' => json_encode($events),
        ]);
    }
}
