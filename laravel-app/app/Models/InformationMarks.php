<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationMarks extends Model
{
    protected $table = 'information_marks';

    public $timestamps = false;

    public static function getMark($id)
    {
        $result = self::query(['mark'])->where('id', $id)->first();
        return $result->mark;
    }
}
