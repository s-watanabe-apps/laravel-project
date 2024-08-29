<?php
namespace App\Libs;

/**
 * ステータスクラス.
 */
class Status
{
    // 定数
    public const DISABLED = 0;
    public const ENABLED = 1;

    /**
     * ステータス名取得.
     *
     * @param int $status
     * @return string
     */
    public static function getStatusName($status)
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