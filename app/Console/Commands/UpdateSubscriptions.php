<?php

namespace App\Console\Commands;



use App\Models\Profile;
use App\Models\VipSubscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class UpdateSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina las suscripciones vip de usuarios sin coins y actualiza el campo is_vip del usuario';

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

        // si no tiene coins suficientes 5 dias antes que caduque s el envia notificacion


        $vip_subs= VipSubscription::where('ends_at','<=', Carbon::now())->where('status',1)->get();
        $count= count($vip_subs);
        $this->info("vips $count");
        foreach($vip_subs as $subscription){

            $profile=$subscription->Profile;
            $type= $profile->type_id;
            // seleccionamos el perfil adecuado
            $subscription_cost= $type==1 ? escortCost():agencyCost();
            $profile=Profile::where('id',$subscription->profile_id)->first();
            $this->info("coste: $subscription_cost monedas");
            // comprobamos que tenga monedas
            $user=$profile->User;
            $remaining_coins= $user->coins - $subscription_cost;
            $this->info("tendrà $remaining_coins coins");

            // borramos suscripción y quitamos de vip si no tiene suficientes monedas
            if($remaining_coins < 0){
                $this->info("borrado");
                $subscription->update(['status'=>0]);
                $profile->update(['is_vip'=>0]);

            }else{
                $this->info("actualizado");
                $new_end=Carbon::now()->addMonth();
                $subscription->update(['ends_at'=>$new_end]);
                $user->update(['coins'=>$remaining_coins]);
            }

        };
    }
}
