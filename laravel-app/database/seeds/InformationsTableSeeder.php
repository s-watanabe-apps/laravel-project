<?php
use App\Models\Informations;
use App\Libs\Status;
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
        DB::table('informations')->truncate();
        $informations = [
            'title' => 'メンテナンスのお知らせ',
            'mark_id' => 1,
            'body' => '<p>システムメンテナンスのため、下記日程にてサービス停止を予定しております。<br>■システム停止期間：0000年00月00日（○曜日）00:00～00:00</p>',
            'status' => Status::ENABLED,
            'start_time' => $now,
            'end_time' => null,
            'created_at' => $now,
            'updated_at' => null,
            'deleted_at' => null,
        ];
        Informations::query()->create($informations);
    }
}