<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Tipo_usuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_usuarios')->insert([
            'nombre' => 'Administrador'
        ]);

        DB::table('tipo_usuarios')->insert([
            'nombre' => 'Vendedor'
        ]);

        DB::table('tipo_usuarios')->insert([
            'nombre' => 'Cliente'
        ]);
    }
}
