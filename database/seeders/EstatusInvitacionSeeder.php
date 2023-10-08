<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusInvitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estatus_invitacions')->insert([
            'nombre' => 'Pendiente',
        ]);

        DB::table('estatus_invitacions')->insert([
            'nombre' => 'Aceptada',
        ]);

        DB::table('estatus_invitacions')->insert([
            'nombre' => 'Cancelada',
        ]);
    }
}
