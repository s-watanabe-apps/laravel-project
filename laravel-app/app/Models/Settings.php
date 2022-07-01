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
            $this->anonymous_permission = 0;
        }
        parent::__construct();
    }

    /**
     * Save settings.
     * 
     * @param App\Http\Requests\ManagementsSettingsPostRequest
     * @return App\Models\Settings
     */
    public function saveSettings($request)
    {
        $settings = $this->where('id', 1)->update([
            'site_name' => $request->site_name,
            'site_description' => $request->site_description,
            'user_create_any' => $request->user_create_any ?? 0,
            'user_create_member' => $request->user_create_member ?? 0,
            'basic_auth' => $request->basic_auth,
            'basic_user' => $request->basic_user ?? null,
            'basic_password' => $request->basic_password ?? null,
            'anonymous_permission' => $request->anonymous_permission,
        ]);

        if (redis()) {
            Redis::del('settings');
        }

        return $settings;
    }

    /**
     * Get settings.
     * 
     * @return App\Models\Settings
     */
    public function get() {
        $cache = null;
        try {
            if (redis()) {
                $cache = Redis::get('settings');
            }
        } catch (Exception $e) {
            //
        }

        if ($cache != null) {
            $settings = new Settings();
            $settings->bind(json_decode($cache));
        } else {
            $settings = $this->query()->first();
            Redis::set('settings', json_encode($settings));
        }

        return $settings;
    }
}
