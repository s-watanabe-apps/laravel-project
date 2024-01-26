<?php
use App\Models\Themes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->truncate();
        $themes = [
            [
                'name' => 'Light',
                'header_color' => '#223134cc',
                'text_color' => '#565656',
                'background_color' => '#ffffff',
                'body_color' => '#eeffff',
                'border_color' => '#ededed',
                'a_color' => '#4169e1',
                'th_color' => '#eeeeee',
            ],
        ];
        foreach($themes as $theme) {
            Themes::query()->create($theme);
        }
    }
}