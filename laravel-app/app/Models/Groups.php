<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
    // Table name.
    public $table = 'groups';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;
}
