<?php
use App\Models\Users;
use App\Models\Roles;
use Carbon\Carbon;
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
        if (config('app.debug')) {
            for ($i = 1; $i <= 15; $i++) {
                Users::query()->create([
                    'role_id' => $i == 1 ? Roles::ADMIN : Roles::MEMBER,
                    'name' => sprintf('ユーザー名_%02d', $i),
                    'name_kana' => sprintf('ユーザーメイ_%02d', $i),
                    'email' => sprintf('member%02d@example.com', $i),
                    'password' => Hash::make('password'),
                    'birthyear' => 1990,
                    'birthmonth' => (new Carbon())->addDays($i)->copy()->format('n'),
                    'birthday' => (new Carbon())->addDays($i)->copy()->format('j'),
                ]);
            }
        }
    }
}