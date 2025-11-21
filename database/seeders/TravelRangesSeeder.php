<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelRangesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travel_ranges')->insert([
            ['id'=>1,'name'=>'Local'],
            ['id'=>2,'name'=>'Province'],
            ['id'=>3,'name'=>'Nation'],
            ['id'=>4,'name'=>'International'],
            ['id'=>5,'name'=>'No'],
        ]);
    }
}
