<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Alejandro',
            'lastname' => 'Jaimes Donatto',
            'email' => 'ale_donatto@yahoo.com.mx',
            'email_verified_at' => '2020-12-07 02:47:00',
            'password' => Hash::make('alejandro'),
            'rol' => 1,
            'client_id' => ''
        ]);
    }
}
