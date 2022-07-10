<?php

namespace App\Http\Controllers\Api;

use App\Services\Calendar;
use App\Http\Requests\ApiEventsGetRequest;

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
     * @param  App\Http\Requests\ApiEventsGetRequest
     * @return json
     */
    public function get(ApiEventsGetRequest $request)
    {
        $events = Calendar::getEvents($request->start, $request->end);
        return response()->json($events);
    }
}
