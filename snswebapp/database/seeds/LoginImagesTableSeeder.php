<?php
use App\Models\LoginImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('login_images')->truncate();
        $loginImages = [
            ['file_name' => '1.jpg',],
            ['file_name' => '2.jpg',],
            ['file_name' => '3.jpg',],
            ['file_name' => '4.jpg',],
            ['file_name' => '5.jpg',],
            ['file_name' => '6.jpg',],
        ];
        foreach($loginImages as $image) {
            LoginImages::query()->create($image);
        }
    }
}