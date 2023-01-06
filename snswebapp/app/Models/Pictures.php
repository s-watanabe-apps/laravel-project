<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Pictures extends Model
{
    use SoftDeletes;

    // Table name.
    public $table = 'pictures';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;

    // Model constant, page limit.
    const PAGENATE = 12;
}
