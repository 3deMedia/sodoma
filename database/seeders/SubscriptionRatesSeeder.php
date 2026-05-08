<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates=[
            ['id'=>1,'profile_type_id'=>1,'cost'=>200],
            ['id'=>2,'profile_type_id'=>2,'cost'=>100]
        ];
        DB::table('subscription_rates')->insert($rates);
    }
}
