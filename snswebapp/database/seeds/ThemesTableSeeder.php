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
                'box_color' => '#efefff',
                'contents_color' => '#deffee',
            ],
            [
                'name' => 'Dark',
                'header_color' => '#4949acaa',
                'text_color' => '#bebebe',
                'background_color' => '#323232',
                'body_color' => '#000000',
                'border_color' => '#787878',
                'a_color' => '#639be2',
                'th_color' => '#a9a9a9',
                'box_color' => '#454545',
                'contents_color' => '#565677',
            ],
            [
                'name' => 'Azure',
                'header_color' => '#1e90ffee',
                'text_color' => '#767676',
                'background_color' => '#f0ffff',
                'body_color' => '#ffffff',
                'border_color' => '#efefef',
                'a_color' => '#639be2',
                'th_color' => '#acdbff',
                'box_color' => '#f0f8ff',
                'contents_color' => '#a3ffef',
            ],
        ];
        foreach($themes as $theme) {
            Themes::query()->create($theme);
        }
    }
}