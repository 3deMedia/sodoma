<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexualOrientationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexual_orientations')->insert([
            ['id'=>1,'name'=>'Straight'],
            ['id'=>2,'name'=>'Gay'],
            ['id'=>3,'name'=>'Bisexual'],
        ]);
    }
}
