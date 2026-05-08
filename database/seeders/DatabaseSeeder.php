<?php

namespace Database\Seeders;

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
            ProfileTypesSeeder::class,
            EyeColorSeeder::class,
            HairColorSeeder::class,
            SexualOrientationSeeder::class,
            TravelRangesSeeder::class,
            LanguagesSeeder::class,
            ServicesSeeder::class,
            NationalitiesSeeder::class,
            GeoSeeder::class,
            PayAmountsSeeder::class,
            CategoryTextSeeder::class,
            UserSeeder::class,
            SeoSeeder::class,
            FaqsSeeder::class,
            SubscriptionRatesSeeder::class,
            // ProfileSeeder::class,
            ConfigurationSeeder::class

        ]);
    }
}
