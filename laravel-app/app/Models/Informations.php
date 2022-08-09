<?php
namespace App\Models;

class Informations extends Model
{
    // Table name.
    public $table = 'informations';

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
