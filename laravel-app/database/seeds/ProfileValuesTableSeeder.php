<?php
use App\Models\ProfileValues;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_values')->truncate();
        $profileValues = [
            [
                'user_id' => 1,
                'profile_id' => 1,
                'value' => '1',
            ],
            [
                'user_id' => 2,
                'profile_id' => 1,
                'value' => '2',
            ],
            [
                'user_id' => 1,
                'profile_id' => 2,
                'value' => '自己紹介１',
            ],
            [
                'user_id' => 2,
                'profile_id' => 2,
                'value' => '自己紹介２',
            ],
        ];
        foreach($profileValues as $profileValue) {
            ProfileValues::query()->create($profileValue);
        }
    }
}