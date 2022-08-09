<?php
namespace App\Services;

use App\Models\Settings;
use App\Http\Requests\ManagementsSettingsRequest;

class SettingsService extends Service
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

        cache()->forget('settings');

        return $settings;
    }

    /**
     * Get settings from Cache or Database.
     * 
     * @return App\Models\Settings
     */
    public function get()
    {
        $settings = new Settings();

        $cache = $this->remember($settings->table, function() {
            $data = Settings::query()->select()->first();
            return json_encode($data);
        });

        return $settings->bind($cache);
    }
}
