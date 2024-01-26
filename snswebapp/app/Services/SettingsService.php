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
                'settings.theme_id',
                \DB::raw('themes.name as theme_name'),
                'themes.header_color',
                'themes.text_color',
                'themes.background_color',
                'themes.body_color',
                'themes.border_color',
                'themes.a_color',
                'themes.th_color',
                //'settings.header_image_id',
                //\DB::raw('header_images.file_name as header_file_name'),
                //'header_images.title_color',
                //'settings.login_image_id',
                //\DB::raw('login_images.file_name as login_file_name'),
            ])
            ->where('settings.id', 1)
            ->leftJoin('themes', 'settings.theme_id', '=', 'themes.id');
            //->leftJoin('header_images', 'settings.header_image_id', '=', 'header_images.id')
            //->leftJoin('login_images', 'settings.login_image_id', '=', 'login_images.id');
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
