<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Nivel_paqueteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nivel_paquetes')->insert([
            'nombre' => 'Plata',
            'costo' => 0,
            'descripcion' => 'pendiente'
        ]);

        DB::table('nivel_paquetes')->insert([
            'nombre' => 'Oro',
            'costo' => 0,
            'descripcion' => 'pendiente'
        ]);

        DB::table('nivel_paquetes')->insert([
            'nombre' => 'Diamante',
            'costo' => 0,
            'descripcion' => 'pendiente'
        ]);
    }
}
