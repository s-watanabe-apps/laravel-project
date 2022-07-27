<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
    use SoftDeletes;

    const PAGENATE = 12;
}
