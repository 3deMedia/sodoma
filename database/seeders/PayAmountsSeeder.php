<?php

namespace Database\Seeders;

use App\Models\PaymentAmount;
use Illuminate\Database\Seeder;

class PayAmountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amounts= [
            ['text'=>'Ingreso de 20 €','coins'=>20,'euros'=>20,'stripe_price_id'=>'price_1KsouHGZ7rWLXJh1ShMDvUVU'],
            ['text'=>'Ingreso de 40 €','coins'=>40,'euros'=>40,'stripe_price_id'=>'price_1KsoveGZ7rWLXJh1PAp4RQ1s'],
            ['text'=>'Ingreso de 60 €','coins'=>60,'euros'=>60,'stripe_price_id'=>'price_1KsowCGZ7rWLXJh1EnuLJtTc'],
            ['text'=>'Ingreso de 100 €','coins'=>100,'euros'=>100,'stripe_price_id'=>'price_1KsowgGZ7rWLXJh1rbObhkmv'],
            ['text'=>'Ingreso de 180 €','coins'=>180,'euros'=>180,'stripe_price_id'=>'price_1KsoxJGZ7rWLXJh1UFD3CQuC'],
        ];
        foreach($amounts as $amount){
            PaymentAmount::create($amount);
        }

    }
}
