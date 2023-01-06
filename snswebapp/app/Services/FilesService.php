<?php
namespace App\Services;

class FilesService extends Service
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
