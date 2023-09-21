<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class MostrarEventos extends Component
{
    #[On('eliminarEvento')]
    public function eliminarVacante(Evento $evento){
        if( $evento->imagen ) {
            Storage::delete('public/eventos/' . $evento->imagen);
        }
        dd($evento);
        // $evento->delete();
    }
    
    public function render()
    {
        $eventos = Evento::paginate(10);
        return view('livewire.mostrar-eventos',compact('eventos'));
    }
}
