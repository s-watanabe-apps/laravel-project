<?php
declare(strict_types = 1);
use Carbon\Carbon;

if (!function_exists('carbon')) {
    /**
     * global carbon.
     *
     * @param null $time time
     * @param null $timezone timezone
     * @param string $format date format
     * @return Carbon
     */
    function carbon($time = null, $timezone = null, $format = 'Y-m-d H:i:s'): Carbon
    {
        $timezone = $timezone ?: config('app.timezone');
        if (empty($time)) {
            return Carbon::now($timezone);
        } elseif (is_int($time) || ctype_digit($time)) {
            return Carbon::createFromTimestamp($time, $timezone);
        } elseif (is_string($time)) {
            return Carbon::parse($time, $timezone);
        } else {
            return Carbon::createFromFormat($format, $time, $timezone);
        }
    }
}