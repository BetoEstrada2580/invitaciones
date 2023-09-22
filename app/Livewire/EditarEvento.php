<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;
use App\Models\Plantilla;
use App\Models\Tipo_evento;
use App\Models\Nivel_paquete;
use App\Models\User;
use Illuminate\Support\Carbon;

class EditarEvento extends Component
{   
    public $evento_id;
    public $clave;
    public $email;
    public $tipo_evento_id;
    public $nivel_paquete_id;
    public $plantilla_id;
    public $festejado;
    public $titulo;
    public $fecha;
    public $user_id;


    protected function rules()
    {
        return [
            'clave' => ['required', 'string', 'max:255','unique:eventos,clave,'.$this->evento_id,'alpha_num'],
            'email' => ['required','unique:users,email,'.$this->user_id,'email','max:60'],
            'tipo_evento_id' => ['required', 'numeric'],
            'nivel_paquete_id' => ['required', 'numeric'],
            'plantilla_id' => ['required', 'numeric'],
            'festejado' => ['required', 'string', 'max:255'],
            'titulo' => ['required', 'string', 'max:255'],
            'fecha' => ['required'],
        ];
    }
    
    public function mount(Evento $evento){
        $this->evento_id = $evento->id;
        $this->clave = $evento->clave;
        $this->email = $evento->usuario->email;
        $this->tipo_evento_id = $evento->tipo_evento_id;
        $this->nivel_paquete_id = $evento->nivel_paquete_id;
        $this->plantilla_id = $evento->plantilla_id;
        $this->festejado = $evento->festejado;
        $this->titulo = $evento->titulo;
        $this->fecha = Carbon::parse($evento->ultimo_dia)->format('Y-m-d') . 'T' . Carbon::parse($evento->ultimo_dia)->format('h:i');
        $this->user_id = $evento->user_id;
    }

    public function render()
    {   
        $tipo_eventos = Tipo_evento::all();
        $nivel_paquetes = Nivel_paquete::all();
        $plantillas = Plantilla::all();
        return view('livewire.editar-evento',compact('tipo_eventos','nivel_paquetes','plantillas'));
    }

    public function editarEvento() 
    {
        $datos = $this->validate();
        //* Encontrar la evento
        $evento = Evento::find($this->evento_id);
        //* Asignar los valores
        $evento->clave = $datos['clave'];
        $evento->tipo_evento_id = $datos['tipo_evento_id'];
        $evento->nivel_paquete_id = $datos['nivel_paquete_id'];
        $evento->plantilla_id = $datos['plantilla_id'];
        $evento->festejado = $datos['festejado'];
        $evento->titulo = $datos['titulo'];
        $evento->fecha = $datos['fecha'];
        //* Guardar la evento
        $evento->save();
        //* Crear un mensaje
        session()->flash('success','El evento se actualizó correctamente');
        //* Redireccionar al usuario
        return redirect()->back();
    }
}
