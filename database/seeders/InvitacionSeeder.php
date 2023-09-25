<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('invitacions')->insert([
            'evento_id' => 1,
            'estatus_invitacion_id' => 1,
            'codigo' => Str::uuid(),
            'nombre' => 'Marlen Maldonado',
            'pases' => 3,
        ]);

        DB::table('invitacions')->insert([
            'evento_id' => 1,
            'estatus_invitacion_id' => 1,
            'codigo' => Str::uuid(),
            'nombre' => 'Cesar Antonio Castillo García',
            'pases' => 2,
        ]);

        DB::table('invitacions')->insert([
            'evento_id' => 1,
            'estatus_invitacion_id' => 1,
            'codigo' => Str::uuid(),
            'nombre' => 'Angel Emanuel Castillo García',
            'pases' => 2,
        ]);
    }
}
