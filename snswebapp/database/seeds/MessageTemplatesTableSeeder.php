<?php

use App\Models\MessageTemplates;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_templates')->truncate();
        $messageTemplates = [
            [
                'type' => MessageTemplates::TYPE_CREATE_USER,
                'subject' => "[{{site_name}}] 招待状",
                'body' => <<< '__BODY__'
{{$name}}さん<br>
<br>
{{$settings->site_name}} への招待状です。<br>
以下のリンクをクリックし、ユーザー登録を完了してください。<br>
<br>
<a href="{{env('APP_URL')}}/hogehoge?token={{$token}}">{{env('APP_URL')}}/hogehoge?token={{$token}}</a><br>
<br>
このメールに見覚えがない場合、お手数ですがこのメールを破棄してください。
__BODY__,
            ],
        ];
        foreach($messageTemplates as $messageTemplate) {
            MessageTemplates::query()->create($messageTemplate);
        }
    }
}