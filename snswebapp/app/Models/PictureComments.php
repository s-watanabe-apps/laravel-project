<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class PictureComments extends Model
{
    use SoftDeletes;

    protected $table = 'picture_comments';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
