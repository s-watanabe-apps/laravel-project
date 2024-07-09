<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
