<?php
use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        $settings = [
            'site_name' => 'SNS WebApp',
            'basic_auth' => true,
            'basic_user' => 'user',
            'basic_password' => 'password',
            'title_informations' => __('strings.title_informations'),
            'title_latest_articles' => __('strings.title_latest_articles'),
        ];
        Settings::query()->insert($settings);
    }
}