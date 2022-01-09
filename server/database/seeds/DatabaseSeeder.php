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
        $this->call([
            CurrencyTableSeeder::class,
            RolesTableSeeder::class,
            CompaniesTableSeeder::class,
            UsersTableSeeder::class,
            ActivationTableSeeder::class,
            // RanksTableSeeder::class,
            ContactTableSeeder::class,
            SettingsTableSeeder::class,
            TasksTableSeeder::class,
            CampaignsTableSeeder::class,
            CountryTableSeeder::class,
            CitiesTableSeeder::class,
            LanguagesTableSeeder::class,
            AdsTableSeeder::class,
            LibrariesTableSeeder::class,
            CategoriesTableSeeder::class,
            // StatsAgeAdTableSeeder::class,
            // StatsAudienceAdTableSeeder::class,
            // StatsCountryAdTableSeeder::class,
            // StatsGenderAdTableSeeder::class,
        ]);
    }
}
