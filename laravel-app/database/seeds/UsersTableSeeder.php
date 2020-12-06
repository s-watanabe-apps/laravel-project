<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $users = [
            [
                'name'     => 'テスト',
                'email'    => 'test@test.com',
                'password' => Hash::make('password'),
            ],
        ];
        foreach($users as $user) {
            App\User::query()->create($user);
        }
    }
}