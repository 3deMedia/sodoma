<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EyeColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eye_colors')->insert([
            ['id'=>1,'name'=>'Brown'],
            ['id'=>2,'name'=>'Blue'],
            ['id'=>3,'name'=>'Green'],
            ['id'=>4,'name'=>'Dark'],
        ]);
    }
}
