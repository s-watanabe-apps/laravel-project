<?php
use App\Models\Groups;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();

        $groups = [
            [
                'name' => 'グループ１',
                'description' => null,
                'order' => 1,
                'created_at' => carbon(),
                'updated_at' => carbon(),
            ],
            [
                'name' => 'グループ２',
                'description' => null,
                'order' => 2,
                'created_at' => carbon(),
                'updated_at' => carbon(),
            ],
            [
                'name' => 'グループ３',
                'description' => null,
                'order' => 3,
                'created_at' => carbon(),
                'updated_at' => carbon(),
            ]
        ];

        foreach($groups as $group) {
            Groups::query()->create($group);
        }
    }
}