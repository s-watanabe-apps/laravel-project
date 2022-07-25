<?php
use App\Models\NavigationMenus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class NavigationMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navigation_menus')->truncate();
        $navigationMenus = [
            [
                'name' => __('strings.write_articles'),
                'link' => '/articles/write',
                'sort' => 1,
            ],
            [
                'name' => __('strings.pictures'),
                'link' => '/pictures',
                'sort' => 2,
            ],
            [
                'name' => __('strings.member_search'),
                'link' => '/members',
                'sort' => 3,
            ],
            [
                'name' => __('strings.community_search'),
                'link' => '/communities',
                'sort' => 4,
            ],
        ];
        foreach($navigationMenus as $navigationMenu) {
            NavigationMenus::query()->create($navigationMenu);
        }
    }
}