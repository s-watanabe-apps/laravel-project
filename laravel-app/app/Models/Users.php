<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
    // Table name.
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

    /**
     * Anonymous user attributes.
     * 
     * return Object
     */
    public static function anonymous()
    {
        return (object) [
            'id' => 0,
            'role_id' => Roles::ANONYMOUS,
            'email' => null,
            'name' => __('strings.anonymous_user_name'),
            'image_file' => null,
        ];
    }
}
