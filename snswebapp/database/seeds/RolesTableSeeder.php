<?php
use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        $roles = [
            [
                'name' => __('strings.roles.admin'),
            ],
            [
                'name' => __('strings.roles.member'),
            ],
        ];
        foreach($roles as $role) {
            Roles::query()->create($role);
        }
    }
}