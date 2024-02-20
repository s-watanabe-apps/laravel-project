<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class FreePages extends Model
{
    use SoftDeletes;

    // Table name.
    public $table = 'free_pages';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;

    // Multiple assignable attributes.
    protected $fillable = [
        'code',
        'title',
        'body',
    ];
}
