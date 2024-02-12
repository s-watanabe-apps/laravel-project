<?php
declare(strict_types = 1);

if (!function_exists('carbon')) {
    /**
     * Global carbon.
     *
     * @param null $time = null
     * @param null $timezone = null
     * @return Carbon\Carbon
     */
    function carbon($time = null, $timezone = null): Carbon\Carbon
    {
        $timezone = $timezone ?: config('app.timezone');

        if (is_int($time) || ctype_digit($time)) {
            return Carbon\Carbon::createFromTimestamp($time, $timezone);
        } elseif (is_string($time)) {
            return Carbon\Carbon::parse($time, $timezone);
        } else {
            return Carbon\Carbon::now($timezone);
        }
    }

}

if (!function_exists('user')) {
    /**
     * Global authenticating user or anonymous user.
     * 
     * @return App\Models\Users
     */
    function user()
    {
        return auth()->user() ?? App\Models\Users::anonymous();
    }
}

if (!function_exists('settings')) {
    /**
     * Global function that returns settings.
     * 
     * @return App\Models\Settings
     */
    function settings()
    {
        return \Session::get('settings');
    }
}

if (!function_exists('str_date_format')) {
    /**
     */
    function str_date_format($date)
    {
        if (is_numeric($date)) {
            $time = $date;
        } else {
            if (is_null($date)) {
                return '-';
            }
            
            $time = strtotime($date);
            if (!$time) {
                return '-';
            }
        }
        if (\App::getLocale() == 'ja') {
            return date('Y/m/d', $time);
        } else {
            return date('m/d/Y', $time);
        }
    }
}

if (!function_exists('str_datetime_format')) {
    /**
     */
    function str_datetime_format($date, $replace = '-')
    {
        if (is_numeric($date)) {
            $time = $date;
        } else {
            if (is_null($date)) {
                return $replace;
            }
            
            $time = strtotime($date);
            if (!$time) {
                return $replace;
            }
        }
        if (\App::getLocale() == 'ja') {
            return date('Y/m/d H:i', $time);
        } else {
            return date('m/d/Y h:i A', $time);
        }
    }
}