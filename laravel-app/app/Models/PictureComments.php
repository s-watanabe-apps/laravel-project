<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class PictureComments extends Model
{
    use SoftDeletes;

    // Table name.
    public $table = 'picture_comments';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;
}
