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
        $settings = Settings::where('id', 1)->update($request->validated());

        cache()->forget(parent::CACHE_KEY_SETTINGS);

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

        $cache = $this->remember(parent::CACHE_KEY_SETTINGS, function() {
            $data = Settings::query()->select()->first();
            return json_encode($data);
        });

        return $settings->bind($cache);
    }
}
