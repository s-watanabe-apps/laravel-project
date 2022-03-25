<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Services\Calendar;
//use App\Libs\DateFormat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * index Get.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $events = [];

        $now = new Carbon();

        $dates = Calendar::getCalendarDates($now->year, $now->month);

        $users = Users::getBirthdayUsers($dates);

        foreach ($users as $user) {
            $carbon = new Carbon($user->birthdate);
            $events[] = [
                'title' => $user->name,
                'url' => '/profiles/' . $user->id,
                'start' => sprintf("%d-%02d-%02d", $now->year, $carbon->month, $carbon->day),
                'fix' => true,
            ];
        } 

        return view('schedule.index', [
            'events' => json_encode($events),
        ]);
    }
}
