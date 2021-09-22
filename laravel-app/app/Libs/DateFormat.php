<?php

namespace App\Libs;

class DateFormat
{
    private $locale = 'ja';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($locale = null)
    {
        if (!is_null($locale)) {
            $this->locale = $locale;
        }
    }

    /**
     * Date format corresponding to the locale.
     * 
     * @return array
     */
    public function getDateFormat()
    {
        if (strcmp($this->locale, 'ja') == 0) {
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
    public function getDateTimeFormat()
    {
        if (strcmp($this->locale, 'ja') == 0) {
            return 'Y/n/j h:i';
        } else {
            return 'n/j/Y g:i a';
        }
    }

    /**
     * Date(short) format corresponding to the locale.
     * 
     * @return array
     */
    public function getDateFormatShort()
    {
        if (strcmp($this->locale, 'ja') == 0) {
            return 'n/j';
        } else {
            return 'n/j';
        }
    }
}
