<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationCategories extends Model
{
    // Table name.
    public $table = 'information_categories';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = false;
}
