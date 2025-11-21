<?php

use App\Models\Configuration;

function maxPhohos($vip=null){

    $name= $vip ? 'max_escort_vip_photos': 'max_escort_photos';
    $num= Configuration::where('name',$name)->first()->value;
    return intval($num);
}

function adminEmail(){
    return Configuration::where('name','admin_email')->first()->value;
}

function escortCost(){
    return Configuration::where('name','new_escort_cost')->first()->value;
}

function agencyCost(){
    return Configuration::where('name','agency_monthly_cost')->first()->value;
}


function ignoredPhotoMax($profile_id){
    $numbers= Configuration::where('name','ignore_max_photos')->first()->value;
    $num_array= explode(",",$numbers);
    return in_array($profile_id,$num_array);
}
