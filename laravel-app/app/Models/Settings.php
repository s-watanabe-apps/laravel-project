<?php
namespace App\Models;

class Settings extends Model
{
    // Table name.
    public $table = 'settings';

    public $timestamps = false;

    // Attribute default values.
    protected $attributes = [
        'user_create_any' => 0,
        'user_create_member' => 0,
        'basic_user' => null,
        'basic_password' => null,
    ];

    /**
     * Create a new model instance.
     *
     * @param boolean
     * @return void
     */
    public function __construct($initialize = false)
    {
        if ($initialize) {
            $this->id = 1;
            $this->site_name = 'SNS WebApp';
            $this->user_create_any = $this->attributes['user_create_any'];
            $this->user_create_member = $this->attributes['user_create_member'];
            $this->user_create_admin = 1;
            $this->basic_auth = 0;
            $this->basic_user = $this->attributes['basic_user'];
            $this->basic_password = $this->attributes['basic_password'];
            $this->anonymous_permission = 0;
        }

        parent::__construct();
    }
}
