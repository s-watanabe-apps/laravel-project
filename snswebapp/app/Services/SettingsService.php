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
    public function saveProfileFixedItems($params)
    {
        $settings = Settings::where('id', 1)->update([
            'is_display_email' => isset($params['is_display_email']) ? 1 : 0,
            'is_editable_email' => isset($params['is_editable_email']) ? 1 : 0,
            'is_display_name' => isset($params['is_display_name']) ? 1 : 0,
            'is_editable_name' => isset($params['is_editable_name']) ? 1 : 0,
            'is_display_birthdate' => isset($params['is_display_birthdate']) ? 1 : 0,
            'is_editable_birthdate' => isset($params['is_editable_birthdate']) ? 1 : 0,
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
            return json_encode($data);
        });

        return $data;
    }
}
