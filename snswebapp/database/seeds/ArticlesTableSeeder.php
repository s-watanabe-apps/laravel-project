<?php
use App\Models\Articles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = $bodies = [];

        $titles[] = 'Articles Test 1';
        $bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 2';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 3';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 4';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 5';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 6';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 7';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 8';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 9';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 10';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;

$titles[] = 'Articles Test 11';
$bodies[] = <<<__TEXT__
<h2>Test aaaa</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
<h2>Test bbbbb</h2>
<p>Aaaaa bbbbb ccccc ddddd.</p>
<p>Eeeee fffff ggggg hhhhh iiiii jjjjj kkkkk lllll mmmmm nnnnn. Ooooo ppppp qqqqq rrrrr. Sssss ttttt uuuuu vvvvv wwwww xxxxx yyyyy xxxxx.</p>
__TEXT__;


        DB::table('articles')->truncate();

        $articles = [];
        for ($i = 0; $i < count($titles); $i++) {
            $articles[] = [
                'user_id' => 1,
                'type' => Articles::TYPE_MEMBER_ARTICLE,
                'status' => \Status::ENABLED,
                'title' => $titles[$i],
                'body' => $bodies[$i],
                'created_at' => carbon()->addDays(-30 + $i)->copy(),
                'updated_at' => null,
                'deleted_at' => null,
            ];
        }

        foreach ($articles as $value) {
            Articles::query()->create($value);
        }
    }
}