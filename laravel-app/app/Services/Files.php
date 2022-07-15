<?php

namespace App\Services;

class Files
{
    static $extensions = [
        'txt', 'pdf', 'zip',
    ];

    public static function getRegex()
    {
        return sprintf(".*[%s]", implode(',', array_map(
            function($value) {
              return '\.' . $value;
            },
            self::$extensions
        )));

    }
}
