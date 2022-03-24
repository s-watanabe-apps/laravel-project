<?php
use App\Models\InformationMarks;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InformationMarksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information_marks')->truncate();
        $informationMarks = [
            ['mark' => 'fa-info-circle',],
            ['mark' => 'fa-bolt',],
            ['mark' => 'fa-flag',],
        ];
        foreach($informationMarks as $informationMark) {
            InformationMarks::query()->create($informationMark);
        }
    }
}