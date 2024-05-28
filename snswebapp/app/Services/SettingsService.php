<?php
namespace App\Services;

use App\Models\Settings;
use App\Http\Requests\ManagementsSettingsRequest;

class SettingsService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Settings::query()->select([
                'settings.*',
                \DB::raw('themes.name as theme_name'),
                'themes.header_color',
                'themes.text_color',
                'themes.background_color',
                'themes.body_color',
                'themes.border_color',
                'themes.a_color',
                'themes.th_color',
                'themes.box_color',
                'themes.contents_color',
                //'settings.header_image_id',
                //\DB::raw('header_images.file_name as header_file_name'),
                //'header_images.title_color',
                'settings.login_image_id',
                \DB::raw('login_images.file_name as login_file_name'),
                'settings.title_informations',
                'settings.title_latest_articles',
            ])
            ->where('settings.id', 1)
            ->leftJoin('themes', 'settings.theme_id', '=', 'themes.id')
            //->leftJoin('header_images', 'settings.header_image_id', '=', 'header_images.id')
            ->leftJoin('login_images', 'settings.login_image_id', '=', 'login_images.id');
    }

    /**
     * サイト設定保存.
     * 
     * @param array $params
     * @return App\Models\Settings
     */
    public function save($params)
    {
        $settings = Settings::where('id', 1)->update($params);

        cache()->forget(parent::CACHE_KEY_SETTINGS);

        return $settings;
    }

    /**
     * プロフィール固定項目設定保存.
     * 
     * @param array $params
     * @return App\Models\Settings
     */
    public function saveProfileFixedSettings($params)
    {
        $settings = Settings::where('id', 1)->update([
            'profile_fixed_settings' => bindec(
                (isset($params['is_display_email']) ? '1' : '0') .
                (isset($params['is_editable_email']) ? '1' : '0') .
                (isset($params['is_display_name']) ? '1' : '0') .
                (isset($params['is_editable_name']) ? '1' : '0') .
                (isset($params['is_display_birthdate']) ? '1' : '0') .
                (isset($params['is_editable_birthdate']) ? '1' : '0') .
                (isset($params['is_display_group']) ? '1' : '0') .
                (isset($params['is_editable_group']) ? '1' : '0')
            )
        ]);

        cache()->forget(parent::CACHE_KEY_SETTINGS);

        return $settings;
    }

    /**
     * サイト設定取得.
     * 
     * @return App\Models\Settings
     */
    public function get()
    {
        $data = $this->remember(parent::CACHE_KEY_SETTINGS, function() {
            $data = $this->base()->first();
            $profileFixedSettings = str_split(sprintf("%02d", decbin($data->profile_fixed_settings)));
            $data->is_display_email = $profileFixedSettings[0];
            $data->is_editable_email = $profileFixedSettings[1];
            $data->is_display_name = $profileFixedSettings[2];
            $data->is_editable_name = $profileFixedSettings[3];
            $data->is_display_birthdate = $profileFixedSettings[4];
            $data->is_editable_birthdate = $profileFixedSettings[5];
            $data->is_display_group = $profileFixedSettings[6];
            $data->is_editable_group = $profileFixedSettings[7];
            return json_encode($data);
        });

        return $data;
    }
}
