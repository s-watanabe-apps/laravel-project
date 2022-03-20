<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Redis;

class Settings extends Model
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
            $this->id = 1;
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

    public function save($options = [])
    {
        $settings = $this->get();

        if ($settings == null) {
            return parent::save($options);
        }

        $filterd = [];
        foreach ($settings->attributes as $key => $value) {
            if ($settings->$key != $this->$key) {
                $filterd[$key] = $this->$key;
            }
        }

        if (redis()) {
            Redis::del('settings');
        }

        return $this->where('id', $this->id)->update($filterd);
    }

    /**
     * get setting.
     * 
     * @return App\Models\Settings
     */
    public function get() {
        return $this->query()->first();
    }
}
