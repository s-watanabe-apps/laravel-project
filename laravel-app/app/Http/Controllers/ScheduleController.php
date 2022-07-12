<?php

namespace App\Http\Controllers;

use App\Services\Calendar;
use App\Http\Requests\AppRequest;

class ScheduleController extends Controller
{
    /**
     * Get schedule.
     * 
     * @param App\Http\Requests\AppRequest
     * @return Illuminate\View\View
     */
    public function index(AppRequest $request)
    {
        $events = Calendar::getMonthlyCalendar();

        return view('schedule.index', [
            'events' => json_encode($events),
        ]);
    }
}
