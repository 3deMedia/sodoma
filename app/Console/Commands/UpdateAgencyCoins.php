<?php

namespace App\Console\Commands;

use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateAgencyCoins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:agency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza diariamente las coins de las agencias. Siempre son de pago';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $agency_cost=agencyCost();

        $today=Carbon::today();
        $profiles= Profile::where('type_id',2)->where('approved',1)->where('monthly_agency_period','<=',$today)->get();
        $oneMonth= Carbon::today()->addMonth(1);
        foreach ($profiles as $profile) {
            $user= $profile->User;
            $has_enough_coins = $user->coins >=  $agency_cost;
            if($has_enough_coins){
                $coins_left= $user->coins - $agency_cost;
                $user->update(['coins'=>$coins_left]);
                $profile->update(['monthly_agency_period'=>$oneMonth]);

            }else{
                $profile->update(['monthly_agency_period'=>null]);
            }

        }

    }
}
