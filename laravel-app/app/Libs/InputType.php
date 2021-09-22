<?php

namespace App\Libs;

class InputType
{
    public const FILLIN = 1;
    public const DESCRIPTION = 2;
    public const CHOICE = 3;
    //public const SELECT = 4;

    /**
     * Get types KeyValue.
     * 
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::FILLIN => __('string.input_types.fillin'),
            self::DESCRIPTION => __('string.input_types.description'),
            self::CHOICE => __('string.input_types.choice'),
            //self::SELECT => __('string.input_types.select'),
        ];
    }
}
