<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::factory()->count(50)
        ->hasPhotos(4)
        ->hasFeatures(1)
        ->hasAddress(1)
        ->hasRates(1)->create();
    }
}
