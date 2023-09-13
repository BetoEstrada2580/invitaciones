<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tipo_ubicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_ubicacions')->insert([
            'nombre' => 'Ceremonia',
        ]);

        DB::table('tipo_ubicacions')->insert([
            'nombre' => 'Recepcion',
        ]);

        DB::table('tipo_ubicacions')->insert([
            'nombre' => 'Palapa',
        ]);

        DB::table('tipo_ubicacions')->insert([
            'nombre' => 'Salon',
        ]);

        DB::table('tipo_ubicacions')->insert([
            'nombre' => 'Alberca',
        ]);

        DB::table('tipo_ubicacions')->insert([
            'nombre' => 'Casa',
        ]);

        DB::table('tipo_ubicacions')->insert([
            'nombre' => 'After',
        ]);
    }
}
