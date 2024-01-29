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
                'box_color' => '#efefef'
            ],
            [
                'name' => 'Dark',
                'header_color' => '#4949acaa',
                'text_color' => '#bebebe',
                'background_color' => '#000000',
                'body_color' => '#323232',
                'border_color' => '#787878',
                'a_color' => '#639be2',
                'th_color' => '#323232',
                'box_color' => '#454545'
            ],
        ];
        foreach($themes as $theme) {
            Themes::query()->create($theme);
        }
    }
}