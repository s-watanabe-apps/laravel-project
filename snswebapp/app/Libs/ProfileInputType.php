<?php
namespace App\Libs;

/**
 * プロフィール入力タイプクラス.
 */
class ProfileInputType
{
    // 定数
    public const FILLIN = 1;
    public const DESCRIPTION = 2;
    public const CHOICE = 3;
    //public const SELECT = 4;

    /**
     * 入力タイプ取得.
     *
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::FILLIN => __('strings.input_types.fillin'),
            self::DESCRIPTION => __('strings.input_types.description'),
            self::CHOICE => __('strings.input_types.choice'),
            //self::SELECT => __('strings.input_types.select'),
        ];
    }
}
