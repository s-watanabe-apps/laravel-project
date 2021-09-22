<?php

namespace App\Services;

use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
     * getWeeklyCalendar
     * 
     * @var string
     * @return array
     */
    public static function getWeeklyCalendar($startDate = null)
    {
        $dates = [];
        $now = new Carbon();
        $nowDayOfWeek = $now->dayOfWeek;
        for ($i = 0; $i < $nowDayOfWeek; $i++) {
            $dates[] = [
                'date' => $now->addDays($i - $now->dayOfWeek)->copy(),
                'users' => [],
            ];
        }
        for ($j = $nowDayOfWeek; $j < 7; $j++) {
            $dates[] = [
                'date' => $now->addDays($j - $now->dayOfWeek)->copy(),
                'users' => [],
            ];
        }
        
        $users = Users::getBirthdayUsers(array_column($dates, 'date'));

        $usersMap = [];
        foreach ($users as $user) {
            $carbon = new Carbon(
                $user->birthyear . '-' .
                $user->birthmonth . '-' .
                $user->birthday                
            );
            $usersMap[$carbon->format('md')][] = $user;
        }
    
        foreach ($dates as &$date) {
            if (array_key_exists($date['date']->format('md'), $usersMap)) {
                foreach ($usersMap[$date['date']->format('md')] as $user) {
                    array_push($date['users'], $user);
                }
            }
        }

        return $dates;
    }

    /**
     * getCalendarDates
     * 
     * @var string
     * @var string
     * @return array
     */
    public function getCalendarDates($year, $month)
    {
        $dateStr = sprintf('%04d-%02d-01', $year, $month);
        $date = new Carbon($dateStr);
        
        $date->subDay($date->dayOfWeek);
        $count = 31 + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;
        $dates = [];

        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            $dates[] = $date->copy();
        }

        return $dates;
    }
}
