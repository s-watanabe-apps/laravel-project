<?php
use App\Models\ArticleLabels;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleLabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_labels')->truncate();

        $articleLabels = [
            [
                'article_id' => 1,
                'label_id' => 1,
            ],
            [
                'article_id' => 2,
                'label_id' => 1,
            ],
            [
                'article_id' => 3,
                'label_id' => 1,
            ],
            [
                'article_id' => 3,
                'label_id' => 3,
            ],
            [
                'article_id' => 3,
                'label_id' => 4,
            ],
            [
                'article_id' => 4,
                'label_id' => 1,
            ],
            [
                'article_id' => 4,
                'label_id' => 2,
            ],
        ];

        foreach ($articleLabels as $value) {
            ArticleLabels::query()->create($value);
        }
    }
}