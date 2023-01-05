<?php
namespace App\Libs;

class DateFormat
{
    /**
     * Date format corresponding to the locale.
     * 
     * @return array
     */
    public static function getDateFormat()
    {
        if (strcmp(\App::getLocale(), 'ja') == 0) {
            return 'Y/n/j';
        } else {
            return 'n/j/Y';
        }
    }

    /**
     * DateTime format corresponding to the locale.
     * 
     * @return array
     */
    public static function getDateTimeFormat()
    {
        if (strcmp(\App::getLocale(), 'ja') == 0) {
            return 'Y/n/j a h:i';
        } else {
            return 'n/j/Y g:i a';
        }
    }

    /**
     * DateTime full format corresponding to the locale.
     * 
     * @return array
     */
    public static function getDateTimeFullFormat()
    {
        if (strcmp(\App::getLocale(), 'ja') == 0) {
            return 'Y/m/d H:i';
        } else {
            return 'n/j/Y g:i a';
        }
    }

    /**
     * Date(short) format corresponding to the locale.
     * 
     * @return array
     */
    public static function getDateFormatShort()
    {
        if (strcmp(\App::getLocale(), 'ja') == 0) {
            return 'n/j';
        } else {
            return 'n/j';
        }
    }
}
