<?php
use App\Models\Pictures;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pictures')->truncate();

        $pictures = [];
        for ($i = 0; $i < 15; $i++) {
            $pictures[] = [
                'user_id' => 1,
                'file' => urlencode(sprintf('pictures/sample-%d.jpg', $i + 1)),
                'title' => '写真タイトル',
                'description' => '写真コメント',
                'created_at' => carbon()->addDays(-(30 - $i))->copy(),
                'updated_at' => carbon()->addDays(-(30 - $i))->copy(),
            ];
        }

        foreach($pictures as $picture) {
            Pictures::query()->create($picture);
        }
    }
}