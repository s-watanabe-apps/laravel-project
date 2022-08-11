<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Pictures extends Model
{
    use SoftDeletes;

    // Table name.
    public $table = 'pictures';

    const PAGENATE = 12;
}
