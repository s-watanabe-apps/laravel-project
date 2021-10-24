<?php
use App\Models\Informations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class InformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new Carbon();
        DB::table('informations')->truncate();
        $informations = [
            'title' => 'メンテナンスのお知らせ',
            'body' => '<p>システムメンテナンスのため、下記日程にてサービス停止を予定しております。</p><p>■システム停止期間：0000年00月00日（○曜日）00:00～00:00</p>',
            'enable' => true,
            'start_time' => $now,
            'end_time' => null,
            'created_at' => $now,
            'updated_at' => null,
            'deleted_at' => null,
        ];
        Informations::query()->create($informations);
    }
}