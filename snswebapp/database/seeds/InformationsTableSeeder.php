<?php
use App\Models\Informations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = carbon();

        $bodies = [];
        $bodies[] = <<<__TEXT__
<p>システムメンテナンスのため、下記日程にてサービス停止を予定しております。</p>
<p>■システム停止期間：0000年00月00日（○曜日）00:00～00:00</p>
__TEXT__;

        DB::table('informations')->truncate();

        $informations = [
            'title' => 'メンテナンスのお知らせ',
            'category_id' => 1,
            'body' => $bodies[0],
            'status' => \Status::ENABLED,
            'start_time' => $now,
            'end_time' => null,
            'created_at' => $now,
            'updated_at' => null,
            'deleted_at' => null,
        ];

        Informations::query()->create($informations);
    }
}