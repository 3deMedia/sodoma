<?php

namespace Database\Seeders;

use App\Models\Categtext;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['id'=>1,'name'=>'barcelona','description_1'=>'La mejor seleccion de escorts','description_2'=>'Esta es la segunda descrippcion sleecion deon de escorts'],
            ['id'=>2,'name'=>'madrid','description_1'=>'La mejor seleccion de escorts','description_2'=>'Esta es la segunda descrippcion sleecion deon de escorts'],
            ['id'=>3,'name'=>'sevilla','description_1'=>'La mejor seleccion de escorts','description_2'=>'Esta es la segunda descrippcion sleecion deon de escorts'],
            ['id'=>4,'name'=>'bilbao','description_1'=>'La mejor seleccion de escorts','description_2'=>'Esta es la segunda descrippcion sleecion deon de escorts'],
            ['id'=>5,'name'=>'default','description_1'=>'descripcion 1 por defecto','description_2'=>'descripcion 2 por defecto'],
        ];
        DB::table('categories_text')->insert($data);
    }
}
