<?php
use App\Models\ProfileChoices;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileChoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_choices')->truncate();
        $profileChoices = [
            [
                'profile_id' => 1,
                'name' => '男性',
            ],
            [
                'profile_id' => 1,
                'name' => '女性',
            ],
        ];
        foreach($profileChoices as $profileChoice) {
            ProfileChoices::query()->create($profileChoice);
        }
    }
}