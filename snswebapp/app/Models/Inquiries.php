<?php
namespace App\Models;

class Inquiries extends Model
{
    protected $table = 'inquiries';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // 問い合わせステータス定数
    const STATUS_NOT_ANSWERED = 1;
    const STATUS_ANSWERED = 2;
    const STATUS_CLOSE = 3;

    /**
     * 問い合わせステータス配列取得.
     *
     * @return array
     */
    public static function getInquiryStatuses()
    {
        return [
            self::STATUS_NOT_ANSWERED => __('strings.not_answered'),
            self::STATUS_ANSWERED => __('strings.answered'),
            self::STATUS_CLOSE => __('strings.closed'),
        ];
    }

}
