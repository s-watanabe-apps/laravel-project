<?php
use App\Models\HeaderImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HeaderImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('header_images')->truncate();
        $headers = [
            ['file_name' => '1.jpg', 'title_color' => '#454545',],
            ['file_name' => '2.jpg', 'title_color' => '#454545',],
            ['file_name' => '3.jpg', 'title_color' => '#454545',],
            ['file_name' => '4.jpg', 'title_color' => '#454545',],
            ['file_name' => '5.jpg', 'title_color' => '#454545',],
            ['file_name' => '6.jpg', 'title_color' => '#454545',],
            ['file_name' => '7.jpg', 'title_color' => '#454545',],
            ['file_name' => '8.jpg', 'title_color' => '#454545',],
            ['file_name' => '9.jpg', 'title_color' => '#454545',],
            ['file_name' => '10.jpg', 'title_color' => '#454545',],
            ['file_name' => '11.jpg', 'title_color' => '#454545',],
            ['file_name' => '12.jpg', 'title_color' => '#454545',],
        ];
        foreach($headers as $header) {
            HeaderImages::query()->create($header);
        }
    }
}