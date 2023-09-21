<?php

namespace Database\Seeders;

use App\Models\Nivel_paquete;
use App\Models\Plantilla;
use App\Models\Tipo_evento;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eventos')->insert([
            'tipo_evento_id' => Tipo_evento::all()->random()->id,
            'nivel_paquete_id' => Nivel_paquete::all()->random()->id,
            'plantilla_id' => Plantilla::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'clave' => 'FiestaTest',
            'festejado' => 'Festejado Test',
            'titulo' => 'Titulo test',
            'fecha' => date("Y-m-d H:i:s"),
            'mensaje' => 'Mensaje test',
            'titulo_final' => 'Titulo Final test',
            'mensaje_final' => 'Mensaje Final test',
            'hashtag' => '#hashtagTest',
            'video' => 'https://www.youtube.com/watch?v=leIK1aUOF-Q&ab_channel=ClassicalMasterpieces',
            'cancion' => 'www.spotify.com',
            'created_by' => User::all()->random()->id,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_by' => User::all()->random()->id,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

    }
}
