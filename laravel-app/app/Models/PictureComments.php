<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class PictureComments extends Model
{
    use SoftDeletes;

    // Table name.
    public $table = 'picture_comments';
}
