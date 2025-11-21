<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_types')->insert([
            ['id'=>1,'name'=>'Escort'],
            ['id'=>2,'name'=>'Agency'],
            ['id'=>3,'name'=>'Member'],
            ['id'=>4,'name'=>'Club'],
            ['id'=>5,'name'=>'Admin'],

        ]);

    }
}
