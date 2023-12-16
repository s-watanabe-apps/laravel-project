<?php
namespace App\Services;

use App\Models\Settings;
use App\Http\Requests\ManagementsSettingsRequest;

class SettingsService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Settings::query()->select([
                'settings.id',
                'settings.site_name',
                'settings.site_description',
                'settings.user_create_any',
                'settings.user_create_member',
                'settings.user_create_admin',
                'settings.basic_auth',
                'settings.basic_user',
                'settings.basic_password',
                'settings.anonymous_permission',
                'settings.header_id',
                \DB::raw('headers.file_name as header_file_name'),
                'headers.title_color',
            ])
            ->where('settings.id', 1)
            ->leftJoin('headers', 'settings.header_id', '=', 'headers.id');
    }

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
            $data = $this->base()->first();
            return json_encode($data);
        });

        return $settings->bind($cache);
    }
}
