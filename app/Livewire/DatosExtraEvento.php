<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;

class DatosExtraEvento extends Component
{
    public $evento_id;
    public $mensaje;
    public $titulo_final;
    public $mensaje_final;
    public $hashtag;
    public $video;
    public $cancion;
    public $user_id;

    protected function rules()
    {
        return [
            'mensaje'       => ['nullable', 'string', 'max:255'],
            'titulo_final'  => ['nullable','string','max:200'],
            'mensaje_final' => ['nullable','string','max:200'],
            'hashtag'       => ['nullable','string','max:100'],
            'video'         => ['nullable', 'url', 'max:255'],
            'cancion'       => ['nullable', 'url', 'max:255'],
        ];
    }

    public function mount(Evento $evento){
        $this->evento_id = $evento->id;
        $this->mensaje = $evento->mensaje;
        $this->titulo_final = $evento->titulo_final;
        $this->mensaje_final = $evento->mensaje_final;
        $this->hashtag = $evento->hashtag;
        $this->video = $evento->video;
        $this->cancion = $evento->cancion;
        $this->user_id = $evento->user_id;
    }

    public function render()
    {
        return view('livewire.datos-extra-evento');
    }

    public function editarEventoExtra() 
    {
        $datos = $this->validate();
        //* Encontrar la evento
        $evento = Evento::find($this->evento_id);
        //* Asignar los valores
        $evento->mensaje = $datos['mensaje'];
        $evento->titulo_final = $datos['titulo_final'];
        $evento->mensaje_final = $datos['mensaje_final'];
        $evento->hashtag = $datos['hashtag'];
        $evento->video = $datos['video'];
        $evento->cancion = $datos['cancion'];
        //* Guardar la evento
        $evento->save();
        //* Crear un mensaje
        session()->flash('success','El evento se actualizó correctamente');
        //* Redireccionar al usuario
        return redirect()->back();
    }
}
