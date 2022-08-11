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
        $now = carbon();

        $titles = $bodies = [];

        $titles[] = '四季が起こる要因';

        $bodies[] = <<<__TEXT__
<p>地球は太陽の周りを公転しているが、地軸が約23.4°傾いた状態で公転している。そのため南北の半球ごとに太陽の高さが一番高い位置にあるときと一番低い位置にあるときが生じる。夏至には太陽の高さは北半球で一番高く、南半球では一番低くなる。反対に冬至には太陽の高さは北半球で一番低く、南半球では一番高くなる。</p>
<p>地球はほぼ球体であるから、地球上での位置と公転軌道上の位置によって日照角度と日照時間に違いが出てくる。日照角度とは太陽光が地表に照射する角度のことである。同一の光量の場合、照射角が90°に近いほど面積あたりの受光量は大きくなる。つまり太陽が高く昇るときほど地表は強く暖められる。また、地軸の傾きは日照時間も変化させる。夏至には昼間の時間が最大に、冬至には最小になり、その差は高緯度ほど大きくなる。なお、気温の上下変動は太陽の高さよりも若干遅れて生じるため、真夏は夏至から1か月から2か月、真冬は冬至から1か月から2か月程度の期間となる。</p>
__TEXT__;

        DB::table('articles')->truncate();

        $articles = [
            [
                'user_id' => 1,
                'type' => Articles::TYPE_MEMBER_ARTICLE,
                'status' => \Status::ENABLED,
                'title' => $titles[0],
                'body' => $bodies[0],
                'created_at' => $now,
                'updated_at' => null,
                'deleted_at' => null,
            ]
        ];

        foreach ($articles as $value) {
            Articles::query()->create($value);
        }
    }
}