<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::insert([
            ['name'=>'ignore_max_photos','value'=>'1'],
            ['name'=>'max_escort_photos','value'=>"2"],
            ['name'=>'max_escort_vip_photos','value'=>"10"],
            ['name'=>'new_escort_cost','value'=>"40"],
            ['name'=>'admin_email','value'=>'info@escortssecrets.com'],
            ['name'=>'contact_phone','value'=>'663 763 606'],
            ['name'=>'contact_email','value'=>'info@escortssecrets.com'],
            ['name'=>'agency_monthly_cost','value'=>"40"],
        ]);
    }
}
