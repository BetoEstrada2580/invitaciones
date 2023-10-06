<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Imagen;
use App\Models\Galeria;
use Livewire\Component;
use App\Models\Tipo_evento;
use Livewire\Attributes\On;
use App\Models\Nombramiento;
use Livewire\WithPagination;
use App\Models\Nivel_paquete;
use Illuminate\Support\Facades\Storage;

class MostrarEventos extends Component
{
    use WithPagination;
    
    public $clave;
    public $tipo_evento_id;
    public $nivel_paquete_id;

    #[On('buscar')]
    public function buscar($clave,$tipo_evento,$nivel_paquete)
    {
        $this->clave = $clave;
        $this->tipo_evento_id = $tipo_evento;
        $this->nivel_paquete_id = $nivel_paquete;
        $this->resetPage();
    }

    #[On('eliminarEvento')]
    public function eliminarEvento(Evento $evento){
        $principales = Imagen::where('evento_id',$evento->id)->Where('tipo_imagen_id','>','1')->Where('tipo_imagen_id','<','5')->get();
        if( $principales) {
            foreach ($principales as $principal) {
                Storage::delete('public/eventos/' . $principal->url);
            }
        }
        
        $nombramientos = Nombramiento::where('evento_id',$evento->id)->get();
        if( $nombramientos) {
            foreach ($nombramientos as $nombramiento) {
                Storage::delete('public/nombramientos/' . $nombramiento->imagen->url);
            }
        }
        
        $galerias = Galeria::where('evento_id',$evento->id)->get();
        if( $galerias) {
            foreach ($galerias as $galeria) {
                Storage::delete('public/galerias/' . $galeria->imagen->url);
            }
        }
        
        try {
            $evento->delete();
            $this->dispatch('notify', type:'success',title: 'El evento fue eliminado correctamente');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al eliminar el evento');
        }
        
    }
    
    public function render()
    {
        $eventos =Evento::when($this->clave,function($query){
            $query->where('clave','LIKE',"%".$this->clave."%")
            ->orWhere('festejado','LIKE',"%".$this->clave."%");
        })
        ->when($this->tipo_evento_id,function($query){
            $query->where('tipo_evento_id',$this->tipo_evento_id);
        })
        ->when($this->nivel_paquete_id,function($query){
            $query->where('nivel_paquete_id',$this->nivel_paquete_id);
        })
        ->orderBy('fecha')->paginate(10);

        // $eventos = Evento::paginate(10);
        $tipo_eventos = Tipo_evento::all();
        $nivel_paquetes = Nivel_paquete::all();
        return view('livewire.mostrar-eventos',compact('eventos','tipo_eventos','nivel_paquetes'));
    }
}
