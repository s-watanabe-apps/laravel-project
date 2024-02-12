<?php
use App\Models\InformationCategories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InformationCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information_categories')->truncate();
        $informationCategories = [
            ['style' => 'fa-info-circle',],
            ['style' => 'fa-bolt',],
            ['style' => 'fa-flag',],
        ];
        foreach($informationCategories as $category) {
            InformationCategories::query()->create($category);
        }
    }
}