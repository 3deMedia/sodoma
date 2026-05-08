<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('nationalities')->insert([
            ['id'=>1,'name'=>'Spanish'],
            ['id'=>2,'name'=>'Argentina'],
            ['id'=>3,'name'=>'Brasil'],
            ['id'=>4,'name'=>'Canada'],
            ['id'=>5,'name'=>'French'],
            ['id'=>6,'name'=>'Germany'],
            ['id'=>7,'name'=>'Ireland'],
            ['id'=>8,'name'=>'Italian'],
            ['id'=>9,'name'=>'Netherlands'],
            ['id'=>10,'name'=>'Russian'],
            ['id'=>11,'name'=>'Scotland'],
            ['id'=>12,'name'=>'Ucraine'],
            ['id'=>13,'name'=>'United Kingdom'],
            ['id'=>14,'name'=>'Venenzuela'],
            ['id'=>15,'name'=>'Mexico'],
            ['id'=>16,'name'=>'America del Norte'],
            ['id'=>17,'name'=>'America del Sur'],
            ['id'=>18,'name'=>'Europa'],
            ['id'=>19,'name'=>'Afríca'],
            ['id'=>20,'name'=>'Oceanía'],
            ['id'=>21,'name'=>'Asia']
        ]);
    }
}
