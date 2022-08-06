<?php
namespace App\Services;

class CalendarService extends Service
{
    /**
     * Get weekly calendar.
     * 
     * @return array
     */
    public function getWeeklyCalendar()
    {
        $dates = [];
        $now = carbon();
        $nowDayOfWeek = $now->dayOfWeek;

        for ($i = 0; $i < $nowDayOfWeek; $i++) {
            $dates[] = [
                'date' => $now->addDays($i - $now->dayOfWeek)->copy(),
            ];
        }

        for ($j = $nowDayOfWeek; $j < 7; $j++) {
            $dates[] = [
                'date' => $now->addDays($j - $now->dayOfWeek)->copy(),
            ];
        }
        
        return $dates;
    }

    /**
     * Get events for the week.
     * 
     * @return array
     */
    public function getWeeklyCalendarEvents()
    {
        $dates = $this->getWeeklyCalendar();

        $users = (new UsersService())->getBirthdayUsers(array_column($dates, 'date'));

        $usersMap = [];
        foreach ($users as $user) {
            $carbon = carbon($user->birthdate);
            $usersMap[$carbon->format('md')][] = $user;
        }
    
        foreach ($dates as &$date) {
            if (array_key_exists($date['date']->format('md'), $usersMap)) {
                foreach ($usersMap[$date['date']->format('md')] as $user) {
                    $date['users'][] = $user;
                }
            }
        }

        return $dates;
    }

    /**
     * Get monthly calendar dates.
     * 
     * @param string
     * @param string
     * @return array
     */
    public function getMonthlyCalendar($year, $month)
    {
        $dateStr = sprintf('%04d-%02d-01', $year, $month);
        $date = carbon($dateStr);
        
        $date->subDay($date->dayOfWeek);
        $count = 31 + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;
        $dates = [];

        for ($i = 0; $i < $count + 7; $i++, $date->addDay()) {
            $dates[] = $date->copy();
        }

        return $dates;
    }

    /**
     * Get events for the month.
     * 
     * @var Carbon
     * @return array
     */
    public function getMonthlyCalendarEvents($date = null)
    {
        $events = [];

        if ($date == null) {
            $now = carbon();
        } else {
            $now = $date;
        }

        $dates = $this->getMonthlyCalendar($now->year, $now->month);

        $users = (new UsersService())->getBirthdayUsers($dates);

        foreach ($users as $user) {
            $carbon = carbon($user->birthdate);
            $events[] = [
                'title' => $user->name,
                'url' => '/profiles/' . $user->id,
                'start' => sprintf("%d-%02d-%02d", $now->year, $carbon->month, $carbon->day),
                'overlap' => false,
            ];
        } 

        return $events;
    }

    /**
     * Get events by range.
     * 
     * @var string
     * @var string
     * @return array
     */
    public function getEvents($start, $end)
    {
        $events = [];

        //\Log::info($start);
        //\Log::info($end);

        $dates = [];
        $startDatetime = carbon($start);
        $endDatetime = carbon($end);
        $dates[] = $startDatetime->copy();
        while ($endDatetime > $startDatetime) {
            $dates[] = $startDatetime;
            $startDatetime = $startDatetime->addDays(1)->copy();
        }

        //foreach ($range as $value) {
        //    \Log::info($value->toString());
        //}

        $users = (new UsersService())->getBirthdayUsers($dates);
        $year = carbon()->year;
        foreach ($users as $user) {
            $carbon = carbon($user->birthdate);
            $events[] = [
                'title' => $user->name,
                'url' => '/profiles/' . $user->id,
                'start' => sprintf("%d-%02d-%02d", $year, $carbon->month, $carbon->day),
            ];
        } 

        //\Log::info(json_encode($events));

        return $events;
    }
}
