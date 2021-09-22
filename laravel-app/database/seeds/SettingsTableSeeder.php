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
            'name' => 'SNS WebApp',
            'basic_auth' => true,
            'basic_user' => 'user',
            'basic_password' => 'password',
        ];
        Settings::query()->create($settings);
    }
}