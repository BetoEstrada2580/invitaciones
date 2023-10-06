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
        $ubicaciones = Ubicacion::where('evento_id',$this->evento_id)->orderBy('fecha')->get();
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
        try {
            if(!$this->ubicacion_id)
            {
                $this->crearUbicacion($datos);
            }
            else
            {
                $this->editarUbicacion($datos);
            }
            $this->dispatch('notify', type:'success',title: 'Ubicación guardada exitosamente');
            $this->dispatch('close-modal');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al guardar ubicación');
        }
        return redirect()->back();
    }

    public function crearUbicacion($datos)
    {
        Ubicacion::create([
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
        $ubicacion = Ubicacion::find($this->ubicacion_id);
        $ubicacion->tipo_ubicacion_id = $datos['tipo_ubicacion_id'];
        $ubicacion->nombre = $datos['nombre'];
        $ubicacion->fecha = $datos['fecha'];
        $ubicacion->direccion = $datos['direccion'];
        $ubicacion->url = $datos['url'];
        $ubicacion->save();
    }

    #[On('eliminarUbicacion')]
    public function eliminarUbicacion(Ubicacion $ubicacion)
    {
        try {
            $ubicacion->delete();
            $this->dispatch('notify', type:'success',title: 'La ubicación se ha eliminado correctamente');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al eliminar la ubicación del evento');
        }
    }

}
