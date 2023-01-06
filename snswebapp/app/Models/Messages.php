<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Messages extends Model
{
    use SoftDeletes;

    // Table name.
    public $table = 'messages';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;
}
