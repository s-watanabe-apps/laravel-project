<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(InformationsTableSeeder::class);
        $this->call(InformationMarksTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(ProfileChoicesTableSeeder::class);
        $this->call(ProfileValuesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(VisitedUsersTableSeeder::class);
        $this->call(PicturesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(MessageTemplatesTableSeeder::class);
        $this->call(NavigationMenusTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(LabelsTableSeeder::class);
        $this->call(ArticleLabelsTableSeeder::class);
    }
}
