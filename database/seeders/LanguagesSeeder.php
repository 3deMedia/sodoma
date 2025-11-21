<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_languages')->insert([
            ['id'=>1,'name'=>'Spanish'],
            ['id'=>2,'name'=>'English'],
            ['id'=>3,'name'=>'French'],
            ['id'=>4,'name'=>'Italian'],
            ['id'=>5,'name'=>'Portuguese'],
            ['id'=>6,'name'=>'Russian'],
            ['id'=>7,'name'=>'Chinese'],
            ['id'=>8,'name'=>'Arab'],
        ]);
    }
}
