<?php
namespace App\Libs;

class Status
{
    public const DISABLED = 0;
    public const ENABLED = 1;

    public static function get_status_name($status)
    {
        if ($status == self::DISABLED) {
            return __('strings.disable');
        } else if ($status == self::ENABLED) {
            return __('strings.enable');
        } else {
            return '-';
        }
    }
}