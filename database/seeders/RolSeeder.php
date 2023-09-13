<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rols')->insert([
            'nombre' => 'Administrador'
        ]);

        DB::table('rols')->insert([
            'nombre' => 'Vendedor'
        ]);

        DB::table('rols')->insert([
            'nombre' => 'Cliente'
        ]);
    }
}
