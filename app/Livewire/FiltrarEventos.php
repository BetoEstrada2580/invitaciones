<?php

namespace App\Livewire;

use App\Models\Nivel_paquete;
use App\Models\Tipo_evento;
use Livewire\Component;

class FiltrarEventos extends Component
{
    public $clave;
    public $tipo_evento_id;
    public $nivel_paquete_id;

    public function formBuscar()
    {
        $this->dispatch('buscar',$this->clave,$this->tipo_evento_id,$this->nivel_paquete_id);
    }
    
    public function render()
    {
        $tipo_eventos = Tipo_evento::all();
        $nivel_paquetes = Nivel_paquete::all();
        return view('livewire.filtrar-eventos',compact('tipo_eventos','nivel_paquetes'));
    }
}
