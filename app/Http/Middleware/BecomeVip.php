<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BecomeVip
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user= $request->user();
        $profile= $user->Profile();

        $vip_cost=     $user->user_type_ide==1 ? escortCost():agencyCost();
        $has_enough_coins = $user->coins >= $vip_cost;

        if($profile && !$profile->is_vip && $user->user_type_id == 1 && $has_enough_coins){
            return $next($request);
        }
        return redirect('my-account');
    }
}
