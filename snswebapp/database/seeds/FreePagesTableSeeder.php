<?php
use App\Models\FreePages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FreePagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('free_pages')->truncate();

        $freePages = [
            [
                'code' => 'P001',
                'title' => 'ページタイトル',
                'body' => '<p>このページは、</p><br><p>テストページです。</p>',
                'status' => 1,
                'created_at' => carbon(),
                'updated_at' => carbon(),
            ],
        ];

        foreach($freePages as $value) {
            FreePages::query()->create($value);
        }
    }
}