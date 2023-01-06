<?php
use App\Models\VisitedUsers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VisitedUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visited_users')->truncate();
        $now1 = carbon();
        $now2 = carbon()->addDays(-1)->copy();
        $visitedUsers = [
            [
                'date' => $now1,
                'user_id' => 1,
                'visited_id' => 2,
                'created_at' => $now1
            ],
            [
                'date' => $now2,
                'user_id' => 1,
                'visited_id' => 3,
                'created_at' => $now2
            ],
        ];
        foreach($visitedUsers as $visitedUser) {
            VisitedUsers::query()->create($visitedUser);
        }
    }
}