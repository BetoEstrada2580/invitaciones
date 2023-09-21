<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Evento;
use Livewire\Component;
use App\Models\Plantilla;
use App\Models\Tipo_evento;
use Illuminate\Support\Str;
use App\Models\Nivel_paquete;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class CrearEvento extends Component
{
    public $clave;
    public $email;
    public $tipo_evento_id;
    public $nivel_paquete_id;
    public $plantilla_id;
    public $festejado;
    public $titulo;
    public $fecha;

    protected $rules = [
        'clave' => ['required', 'string', 'max:255','unique:'.Evento::class,'alpha_num'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'tipo_evento_id' => ['required', 'numeric'],
        'nivel_paquete_id' => ['required', 'numeric'],
        'plantilla_id' => ['required', 'numeric'],
        'festejado' => ['required', 'string', 'max:255'],
        'titulo' => ['required', 'string', 'max:255'],
        'fecha' => ['required'],
    ];

    public function crearEvento() 
    {
        $datos = $this->validate();

        $user = User::create([
            'name' => $datos['festejado'],
            'email' => $datos['email'],
            'rol_id' => 3, //Cliente
            'password' => Hash::make(Str::random(10)),
        ]);

        event(new Registered($user));

        //* Crear el evento
        Evento::create([
            'clave'=>$datos['clave'],
            'tipo_evento_id'=>$datos['tipo_evento_id'],
            'nivel_paquete_id'=>$datos['nivel_paquete_id'],
            'plantilla_id'=>$datos['plantilla_id'],
            'festejado'=>$datos['festejado'],
            'titulo'=>$datos['titulo'],
            'fecha'=>$datos['fecha'],
            'user_id'=> auth()->user()->id,
            'created_by'=> auth()->user()->id,
            'updated_by'=> auth()->user()->id
        ]);

        //* Crear un mensaje
        session()->flash('success','Evento creado exitosamente');

        //* Redireccionar al usuario
        return redirect()->route('evento.index');
    }


    public function render()
    {
        $tipo_eventos = Tipo_evento::all();
        $nivel_paquetes = Nivel_paquete::all();
        $plantillas = Plantilla::all();
        return view('livewire.crear-evento',compact('tipo_eventos','nivel_paquetes','plantillas'));
    }
}
