<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMesaRegaloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_mesa_regalos')->insert([
            'nombre' => 'Liverpool',
        ]);

        DB::table('tipo_mesa_regalos')->insert([
            'nombre' => 'Amazon',
        ]);

        DB::table('tipo_mesa_regalos')->insert([
            'nombre' => 'Palacio de hierro',
        ]);

        DB::table('tipo_mesa_regalos')->insert([
            'nombre' => 'Transferencia',
        ]);

    }
}
