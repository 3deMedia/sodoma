<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            ['id'=>1,'name'=>'69', 'catslug' => '69', 'catdescription' => 'Descripcion', 'catimg' => 'url'],
            ['id'=>2,'name'=>'atencion-mujeres', 'catslug'=>'atencion-mujeres', 'catdescription'=>'Atención a mujeres', 'catimg' => 'url'],
            ['id'=>3,'name'=>'atencion-parejas', 'catslug'=>'atencion-parejas', 'catdescription'=>'Atención a parejas', 'catimg' => 'url'],
            ['id'=>4,'name'=>'baile-erotico','catslug'=>'baile-erotico','catdescription'=>'Baile erótico', 'catimg' => 'url'],
            ['id'=>5,'name'=>'besos','catslug'=>'besos','catdescription'=>'besos', 'catimg' => 'url'],
            ['id'=>6,'name'=>'bixesual','catslug'=>'bixesual','catdescription'=>'Bixesual', 'catimg' => 'url'],
            ['id'=>7,'name'=>'cim','catslug'=>'cim','catdescription'=>'CIM', 'catimg' => 'url'],
            ['id'=>8,'name'=>'despedidas-soltero','catslug'=>'despedidas-soltero','catdescription'=>'Despedidas de soltero', 'catimg' => 'url'],
            ['id'=>9,'name'=>'duplex','catslug'=>'duplex','catdescription'=>'Duplex', 'catimg' => 'url'],
            ['id'=>10,'name'=>'fantasías-eroticas','catslug'=>'fantasías-eroticas','catdescription'=>'Fantasías eróticas', 'catimg' => 'url'],
            ['id'=>11,'name'=>'fetiche','catslug'=>'fetiche','catdescription'=>'Fetiche', 'catimg' => 'url'],
            ['id'=>12,'name'=>'frances-completo','catslug'=>'frances-completo','catdescription'=>'Francés completo', 'catimg' => 'url'],
            ['id'=>13,'name'=>'frances-natural','catslug'=>'frances-natural','catdescription'=>'Francés natural', 'catimg' => 'url'],
            ['id'=>14,'name'=>'garganta-profunda','catslug'=>'garganta-profunda','catdescription'=>'Garganta profunda', 'catimg' => 'url'],
            ['id'=>15,'name'=>'gfe','catslug'=>'gfe','catdescription'=>'GFE', 'catimg' => 'url'],
            ['id'=>16,'name'=>'griego','catslug'=>'griego','catdescription'=>'Griego', 'catimg' => 'url'],
            ['id'=>17,'name'=>'juegos-de-rol','catslug'=>'juegos-de-rol','catdescription'=>'Juegos de Rol', 'catimg' => 'url'],
            ['id'=>18,'name'=>'juegos-eroticos','catslug'=>'juegos-eroticos','catdescription'=>'Juegos eróticos', 'catimg' => 'url'],
            ['id'=>19,'name'=>'lesbico','catslug'=>'lesbico','catdescription'=>'Lésbico', 'catimg' => 'url'],
            ['id'=>20,'name'=>'masaje-erotico','catslug'=>'masaje-erotico','catdescription'=>'Masaje erótico', 'catimg' => 'url'],
            ['id'=>21,'name'=>'masaje-tantrico','catslug'=>'masaje-tantrico','catdescription'=>'Masaje Tántrico', 'catimg' => 'url'],
            ['id'=>22,'name'=>'striptease','catslug'=>'striptease','catdescription'=>'Striptease', 'catimg' => 'url'],
            ['id'=>23,'name'=>'sex-cam','catslug'=>'sex-cam','catdescription'=>'Sex Cam', 'catimg' => 'url'],
        ]);
    }
}
