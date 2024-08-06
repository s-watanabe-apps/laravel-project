<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    // 広告タイプ定数
    const TYPE_SIDE = 1;
    const TYPE_LIST = 2;
    const TYPE_FOOTER = 3;

    /**
     * 広告タイプ配列取得.
     *
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_SIDE => __('strings.sidemenu'),
            self::TYPE_LIST => __('strings.list'),
            self::TYPE_FOOTER => __('strings.footer'),
        ];
    }

}
