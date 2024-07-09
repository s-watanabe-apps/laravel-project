<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Pictures extends Model
{
    use SoftDeletes;

    protected $table = 'pictures';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // ページング定数
    const PAGENATE = 12;
}
