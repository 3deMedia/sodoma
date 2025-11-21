<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HairColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hair_colors')->insert([
            ['id'=>1,'name'=>'Brown'],
            ['id'=>2,'name'=>'Blonde'],
            ['id'=>3,'name'=>'Black'],
            ['id'=>4,'name'=>'Red'],
            ['id'=>5,'name'=>'Auburn'],
        ]);
    }
}
