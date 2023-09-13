<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tipo_eventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_eventos')->insert([
            'nombre' => 'Boda'
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'XV años'
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Cumpleaños'
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Graduación'
        ]);
    }
}
