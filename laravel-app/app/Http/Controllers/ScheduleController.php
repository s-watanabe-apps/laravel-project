<?php
namespace App\Http\Controllers;

use App\Services\CalendarService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Instance variables.
    private $calendarService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\InformationsService
     * @param App\Services\CalendarService
     * @return void
     */
    public function __construct(
        CalendarService $calendarService
    ) {
        $this->calendarService = $calendarService;
    }

    /**
     * Get schedule.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $events = $this->calendarService->getMonthlyCalendarEvents();

        return view('schedule.index', [
            'events' => json_encode($events),
        ]);
    }
}
