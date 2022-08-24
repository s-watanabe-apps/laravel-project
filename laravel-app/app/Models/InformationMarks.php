<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationMarks extends Model
{
    // Table name.
    public $table = 'information_marks';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = false;
}
