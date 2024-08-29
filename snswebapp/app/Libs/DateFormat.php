<?php
namespace App\Libs;

/**
 * 日付フォーマットクラス.
 */
class DateFormat
{
    /**
     * 日付(年月日)フォーマット取得.
     *
     * @return string
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
     * 日時フォーマット取得(AM/PM表記).
     *
     * @return string
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
     * 日時フォーマット取得.
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
     * 日付(月日)フォーマット取得.
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
