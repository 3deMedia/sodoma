<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::unprepared(file_get_contents(storage_path('app/sql/countries.sql')));
        DB::unprepared(file_get_contents(storage_path('app/sql/regions.sql')));
        DB::unprepared(file_get_contents(storage_path('app/sql/cities.sql')));
    }
}
