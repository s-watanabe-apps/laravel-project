<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Notifications\Notifiable;

class Settings extends Eloquent\Model
{
    use Notifiable;

    protected $table = 'settings';

    public $timestamps = false;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($initialize = false)
    {
        if ($initialize) {
            $this->site_name = 'SNS WebApp';
            $this->user_create_any = 0;
            $this->user_create_member = 0;
            $this->user_create_admin = 1;
            $this->basic_auth = 0;
            $this->basic_user = null;
            $this->basic_password = null;
        }
        parent::__construct();
    }

    /**
     * get setting.
     * 
     * @return App\Models\Settings
     */
    public static function get() {
        return self::query()->first();
    }
}
