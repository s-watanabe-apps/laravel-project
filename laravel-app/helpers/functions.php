<?php
declare(strict_types = 1);

if (!function_exists('carbon')) {
    /**
     * Global carbon.
     *
     * @param null $time time
     * @param null $timezone timezone
     * @param string $format date format
     * @return Carbon\Carbon
     */
    function carbon($time = null, $timezone = null, $format = 'Y-m-d H:i:s'): Carbon\Carbon
    {
        $timezone = $timezone ?: config('app.timezone');
        if (empty($time)) {
            return Carbon\Carbon::now($timezone);
        } elseif (is_int($time) || ctype_digit($time)) {
            return Carbon\Carbon::createFromTimestamp($time, $timezone);
        } elseif (is_string($time)) {
            return Carbon\Carbon::parse($time, $timezone);
        } else {
            return Carbon\Carbon::createFromFormat($format, $time, $timezone);
        }
    }

}

if (!function_exists('user')) {
    /**
     * Global user.
     * 
     * @return \App\Models\Users
     */
    function user()
    {
        return auth()->user() ?? App\Models\Users::anonymous();
    }
}