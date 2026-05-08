<?php

namespace Database\Seeders;



use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'=>'admin@admin.com',
            'password'=>Hash::make('adminadmin'),
            'email_verified_at'=>now(),
            'user_type_id'=>5,
        ]);

    }
}
