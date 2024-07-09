<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class FreePages extends Model
{
    use SoftDeletes;

    protected $table = 'free_pages';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'code',
        'title',
        'body',
    ];
}
