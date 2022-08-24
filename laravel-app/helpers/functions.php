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
     * Global user.
     * 
     * @return \App\Models\Users
     */
    function user()
    {
        return auth()->user() ?? App\Models\Users::anonymous();
    }
}