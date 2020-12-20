<?php

use Illuminate\Database\Seeder;
use App\Roles;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'tipo' => 'admin',
            'descripcion' => 'administrador',
        ]);

        DB::table('roles')->insert([
            'tipo' => 'socio',
            'descripcion' => 'usuarios socios',
        ]);

        DB::table('roles')->insert([
            'tipo' => 'user unit',
            'descripcion' => 'usuario de unidad de negocio',
        ]);

        DB::table('roles')->insert([
            'tipo' => 'cliente',
            'descripcion' => 'cliente en general',
        ]);
    }
}
