<?php
namespace App\Services;

use App\Models\Settings;
use App\Http\Requests\ManagementsSettingsRequest;
use Illuminate\Support\Facades\Redis;

class SettingsService
{
    /**
     * Save settings.
     * 
     * @param App\Http\Requests\ManagementsSettingsRequest
     * @return App\Models\Settings
     */
    public function save(ManagementsSettingsRequest $request)
    {
        $settings = Settings::where('id', 1)->update([
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
            $settings = Settings::query()->first();
            Redis::set('settings', json_encode($settings->toArray()));
        }

        return $settings;
    }
}
