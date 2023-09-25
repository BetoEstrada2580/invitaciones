<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoImagenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_imagens')->insert([
            'nombre' => 'Nombramiento',
        ]);

        DB::table('tipo_imagens')->insert([
            'nombre' => 'Principal',
        ]);

        DB::table('tipo_imagens')->insert([
            'nombre' => 'Secundaria',
        ]);

        DB::table('tipo_imagens')->insert([
            'nombre' => 'Footer',
        ]);

        DB::table('tipo_imagens')->insert([
            'nombre' => 'Galeria',
        ]);

    }
}
