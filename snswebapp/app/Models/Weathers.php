<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Weathers extends Model
{
    protected $table = 'weathers';
    protected $primaryKey = ['city_id', 'time'];
    public $timestamps = true;
}
