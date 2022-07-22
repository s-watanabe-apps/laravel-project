<?php
namespace App\Http\Controllers\Api;

use App\Services\Calendar;
use App\Http\Requests\ApiEventsRequest;

class EventsController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('authcheck');
    }

    /**
     * index Get.
     * 
     * @param  App\Http\Requests\ApiEventsRequest
     * @return json
     */
    public function get(ApiEventsRequest $request)
    {
        $events = Calendar::getEvents($request->start, $request->end);
        return response()->json($events);
    }
}
