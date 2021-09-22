<?php

use App\Models\Messages;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->truncate();
        if (config('app.debug')) {
            $messages = [
                [
                    'from_user_id' => 2,
                    'to_user_id' => 1,
                    'message_id' => 1,
                    'subject' => 'テストメッセージ①',
                    'body' => "テストメッセージ本文\nテストメッセージ本文\nテストメッセージ本文",
                    'readed' => false,
                    'created_at' => new Carbon(),
                    'updated_at' => new Carbon(),
                ],
                [
                    'from_user_id' => 3,
                    'to_user_id' => 1,
                    'message_id' => 2,
                    'subject' => 'テストメッセージ②',
                    'body' => "テストメッセージ本文\nテストメッセージ本文\nテストメッセージ本文",
                    'readed' => false,
                    'created_at' => new Carbon(),
                    'updated_at' => new Carbon(),
                ],
            ];
            foreach($messages as $message) {
                Messages::query()->create($message);
            }
        }
    }
}