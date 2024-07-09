<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // ページング定数
    const PAGENATE = 12;

    /**
     * 属性情報セット.
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
     * 匿名ユーザー属性情報.
     *
     * @return App\Models\Users
     */
    public static function anonymous()
    {
        return (new Users())->bind([
            'id' => 0,
            'role_id' => Roles::ANONYMOUS,
            'email' => null,
            'name' => __('strings.anonymous_user_name'),
            'image_file' => null,
        ]);
    }

    /**
     * 管理者チェック.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role_id == Roles::ADMIN;
    }
}
