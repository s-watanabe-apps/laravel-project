<?php
namespace App\Http\Controllers\Api;

use App\Services\CalendarService;
use App\Http\Requests\ApiEventsRequest;

class EventsController extends ApiController
{
    // Instance variables.
    private $calendarService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CalendarService $calendarService
    ) {
        $this->calendarService = $calendarService;
    }

    /**
     * index Get.
     * 
     * @param  App\Http\Requests\ApiEventsRequest
     * @return json
     */
    public function get(ApiEventsRequest $request)
    {
        $events = $this->calendarService->getEvents($request->start, $request->end);
        return response()->json($events);
    }
}
