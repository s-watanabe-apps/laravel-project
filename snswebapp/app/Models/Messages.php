<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Messages extends Model
{
    use SoftDeletes;

    protected $table = 'messages';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
