<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreePages extends Model
{
    /**
     * Multiple assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'title',
        'body',
    ];

    /**
     * Add as an array.
     * 
     * @var array
     * @return App\Models\FreePages
     */
    public static function add($values) {
        $freePages = new FreePages();
        $freePages->fill($values)->save();
        return $freePages;
    }

    public static function getByCode($code)
    {
        return self::query()->where(['code' => $code,])->first();
    }

}
