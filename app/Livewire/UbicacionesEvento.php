<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Tipo_ubicacion;
use App\Models\Ubicacion;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class UbicacionesEvento extends Component
{
    public $evento_id;
    public $ubicacion_id;
    public $tipo_ubicacion_id;
    public $nombre;
    public $fecha;
    public $direccion;
    public $url;

    protected function rules()
    {
        return [
            'tipo_ubicacion_id' => ['required', 'numeric'],
            'nombre'            => ['required','string','max:200'],
            'fecha'             => ['required'],
            'direccion'         => ['required','string','max:255'],
            'url'               => ['required', 'url', 'max:255'],
        ];
    }

    public function mount(Evento $evento){
        $this->evento_id = $evento->id;
    }

    public function render()
    {   $tipo_ubicaciones = Tipo_ubicacion::all();
        $ubicaciones = Ubicacion::all();
        return view('livewire.ubicaciones-evento',compact('tipo_ubicaciones','ubicaciones'));
    }

    #[On('nuevaUbicacion')]
    public function nuevaUbicacion()
    {
        $evento_id= $this->evento_id;
        $this->reset();
        $this->evento_id = $evento_id;
        $this->resetValidation();
        $this->dispatch('open-modal', 'ModalUbicacion');
    }

    #[On('consultarUbicacion')]
    public function consultarUbicacion(Ubicacion $ubicacion)
    {
        $evento_id= $this->evento_id;
        $this->resetValidation();
        $this->reset();
        $this->evento_id = $evento_id;
        $this->ubicacion_id = $ubicacion->id;
        $this->tipo_ubicacion_id = $ubicacion->tipo_ubicacion_id;
        $this->nombre = $ubicacion->nombre;
        $this->fecha = Carbon::parse($ubicacion->fecha)->format('Y-m-d\TH:i');
        $this->direccion = $ubicacion->direccion;
        $this->url = $ubicacion->url;
        $this->dispatch('open-modal', 'ModalUbicacion');
    }

    public function formUbicacion()
    {
        $datos = $this->validate();
        $exito = 0;
        
        if(!$this->ubicacion_id)
        {
            $exito = $this->crearUbicacion($datos);
        }
        else
        {
            $exito = $this->editarUbicacion($datos);
        }
        if($exito)
        { session()->flash('success','Ubiación guardada exitosamente');}
        else{session()->flash('error','Error al guardar ubicación');}
        $this->dispatch('close-modal');
        return redirect()->back();
    }

    public function crearUbicacion($datos)
    {
        return Ubicacion::create([
            'evento_id'         =>  $this->evento_id,
            'tipo_ubicacion_id' =>  $datos['tipo_ubicacion_id'],
            'nombre'            =>  $datos['nombre'],
            'fecha'             =>  $datos['fecha'],
            'direccion'         =>  $datos['direccion'],
            'url'               =>  $datos['url'],
        ]);
    } 

    public function editarUbicacion($datos)
    {
        // dd( $datos['fecha']);
        $ubicacion = Ubicacion::find($this->ubicacion_id);
        $ubicacion->tipo_ubicacion_id = $datos['tipo_ubicacion_id'];
        $ubicacion->nombre = $datos['nombre'];
        $ubicacion->fecha = $datos['fecha'];
        $ubicacion->direccion = $datos['direccion'];
        $ubicacion->url = $datos['url'];
        return $ubicacion->save();
    }

    #[On('eliminarUbicacion')]
    public function eliminarUbicacion(Ubicacion $ubicacion)
    {
        $ubicacion->delete();
    }

}
