<?php
namespace App\Models;

class Settings extends Model
{
    // Table name.
    public $table = 'settings';

    public $timestamps = false;

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
            $this->user_create_any = 0;
            $this->user_create_member = 0;
            $this->user_create_admin = 1;
            $this->basic_auth = 0;
            $this->basic_user = null;
            $this->basic_password = null;
            $this->anonymous_permission = 0;
        }

        parent::__construct();
    }
}
