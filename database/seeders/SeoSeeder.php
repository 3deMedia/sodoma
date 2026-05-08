<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=[
            ['id'=>1,'route'=>'/secure/faqs','view'=>'faqs','seo_title'=>'Preguntas Frequentes','seo_description'=>'Hola','explanation'=>'Pagina de preguntas frecuentes','seo_keywords'=>'ola,ola'],
            ['id'=>2,'route'=>'/secure/terms','view'=>'terms','seo_title'=>'Hola','seo_description'=>'HOla','explanation'=>'Terminos y condiciones','seo_keywords'=>'ola,ola'],
            ['id'=>3,'route'=>'/secure/privacy','view'=>'privacy','seo_title'=>'HOla','seo_description'=>'ola','explanation'=>'Politica privacidad','seo_keywords'=>'ola,ola'],
            ['id'=>4,'route'=>'/secure/payments','view'=>'payments','seo_title'=>'HOla','seo_description'=>'ola','explanation'=>'Pago seguro','seo_keywords'=>'ola,ola'],
            ['id'=>5,'route'=>'/','view'=>'guest/home','seo_title'=>'','seo_description'=>'','explanation'=>'Página Inicio','seo_keywords'=>'ola,ola'],
            ['id'=>6,'route'=>'/escorts/{ciudad?}/{nombre?}','view'=>'guest/escorts','seo_title'=>'','seo_description'=>'','explanation'=>'Todas las escorts o filtradas','seo_keywords'=>'ola,ola'],
            ['id'=>7,'route'=>'/escort/uid','view'=>'guest/escort-show','seo_title'=>'','seo_description'=>'','explanation'=>'Ver una escort concreta','seo_keywords'=>'ola,ola'],
            ['id'=>8,'route'=>'/agencies','view'=>'guest/agencies','seo_title'=>'','seo_description'=>'','explanation'=>'Todas las agencias','seo_keywords'=>'ola,ola'],
            ['id'=>9,'route'=>'/agency/{uid}','view'=>'guest/agency-show','seo_title'=>'','seo_description'=>'','explanation'=>'Ver una agencia','seo_keywords'=>'ola,ola'],
            ['id'=>10,'route'=>'profiles/{type?}','view'=>'guest/filtered','seo_title'=>'','seo_description'=>'','explanation'=>'Pagina tras usar el filtrador de busqueda','seo_keywords'=>'ola,ola'],
            ['id'=>11,'route'=>'/contact-us','view'=>'guest/contact','seo_title'=>'','seo_description'=>'','explanation'=>'Página de contacto','seo_keywords'=>'ola,ola'],
            ['id'=>12,'route'=>'/blog','view'=>'guest/blog/index','seo_title'=>'ola','seo_description'=>'ola','explanation'=>'Todos los posts','seo_keywords'=>'ola,ola']
        ];
     DB::table('seo_config')->insert($pages);
    }
}
