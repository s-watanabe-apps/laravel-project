<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Weathers extends Model
{
    // Table name.
    public $table = 'weathers';

    // Primary key.
    protected $primaryKey = ['city_id', 'time'];

    // Timestamps.
    public $timestamps = true;
}
