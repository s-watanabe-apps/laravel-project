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
            [
                'article_id' => 5,
                'label_id' => 1,
            ],
            [
                'article_id' => 6,
                'label_id' => 1,
            ],
            [
                'article_id' => 7,
                'label_id' => 1,
            ],
            [
                'article_id' => 8,
                'label_id' => 1,
            ],
            [
                'article_id' => 9,
                'label_id' => 1,
            ],
            [
                'article_id' => 10,
                'label_id' => 1,
            ],
            [
                'article_id' => 11,
                'label_id' => 1,
            ],
        ];

        foreach ($articleLabels as $value) {
            ArticleLabels::query()->create($value);
        }
    }
}