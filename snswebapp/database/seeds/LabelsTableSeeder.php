<?php
use App\Models\Labels;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labels')->truncate();

        $labels = [
            ['value' => '四季'],
            ['value' => '降水量'],
            ['value' => '自然災害'],
            ['value' => '湿潤大陸性気候'],
        ];

        foreach ($labels as $value) {
            Labels::query()->create($value);
        }
    }
}