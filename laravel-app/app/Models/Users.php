<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
    public $table = 'users';

    use SoftDeletes;

    const PAGENATE = 12;

    /**
     * Bind an array to a Instance variables.
     * 
     * @param array
     * @return App\Models\Model
     */
    public function bind($values)
    {
        foreach ($values as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }
}
