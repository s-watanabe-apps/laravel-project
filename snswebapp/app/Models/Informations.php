<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Informations extends Model
{
    use SoftDeletes;

    // Table name.
    public $table = 'informations';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;

    /**
     * Multiple assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'mark_id',
        'title',
        'body',
        'status',
        'start_time',
        'end_time',
    ];
}
