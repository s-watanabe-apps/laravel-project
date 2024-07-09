<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Informations extends Model
{
    use SoftDeletes;

    protected $table = 'informations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'title',
        'body',
        'status',
        'start_time',
        'end_time',
    ];
}
