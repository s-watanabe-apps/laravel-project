<?php
use App\Models\Profiles;
use App\Libs\InputType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->truncate();
        $profiles = [
            [
                'type' => InputType::CHOICE,
                'order' => 1,
                'name' => '性別',
                'required' => true,
            ],
            [
                'type' => InputType::DESCRIPTION,
                'order' => 2,
                'name' => '自己紹介',
                'required' => true,
            ],
        ];
        foreach($profiles as $profile) {
            Profiles::query()->create($profile);
        }
    }
}