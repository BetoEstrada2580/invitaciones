<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tipo_vestimentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_vestimentas')->insert([
            'nombre' => 'Etiqueta',
            'imagen' => '',
        ]);

        DB::table('tipo_vestimentas')->insert([
            'nombre' => 'Formal',
            'imagen' => '',
        ]);

        DB::table('tipo_vestimentas')->insert([
            'nombre' => 'Semi formal',
            'imagen' => '',
        ]);

        DB::table('tipo_vestimentas')->insert([
            'nombre' => 'Casual',
            'imagen' => '',
        ]);

        DB::table('tipo_vestimentas')->insert([
            'nombre' => 'Traje de baño',
            'imagen' => '',
        ]);

        DB::table('tipo_vestimentas')->insert([
            'nombre' => 'Disfraz',
            'imagen' => '',
        ]);
    }
}
