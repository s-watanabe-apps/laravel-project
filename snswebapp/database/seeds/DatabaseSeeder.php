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
        $this->call(SettingsTableSeeder::class);
        $this->call(HeaderImagesTableSeeder::class);
        $this->call(LoginImagesTableSeeder::class);
        $this->call(NavigationMenusTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(InformationCategoriesTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(ProfileChoicesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(InquiryTypesTableSeeder::class);

        if (config('app.debug')) {
            $this->call(UsersTableSeeder::class);
            $this->call(InformationsTableSeeder::class);
            $this->call(ProfileValuesTableSeeder::class);
            $this->call(VisitedUsersTableSeeder::class);
            $this->call(PicturesTableSeeder::class);
            $this->call(MessageTemplatesTableSeeder::class);
            $this->call(ArticlesTableSeeder::class);
            $this->call(LabelsTableSeeder::class);
            $this->call(ArticleLabelsTableSeeder::class);
            $this->call(GroupsTableSeeder::class);
            $this->call(FreePagesTableSeeder::class);
        }
    }
}
