<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;
use App\Models\Invitacion;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class MostrarInvitaciones extends Component
{
    public $evento_id;
    public $invitacion_id;
    public $nombre;
    public $telefono;
    public $email;
    public $estatusFilter;
    public $pases;

    protected function rules()
    {
        return [
            'nombre'    => ['required','string','max:255'],
            'telefono'  => ['required', 'numeric','digits:10'],
            'email'     => ['nullable', 'string', 'email', 'max:100'],
            'pases'  => ['required', 'numeric','max:99'],
        ];
    }

    public function mount(Evento $evento){
        $this->evento_id = $evento->id;
    }

    public function render()
    {
        $invitaciones = Invitacion::where('evento_id',$this->evento_id)->orderBy('nombre')->paginate(10);
        return view('livewire.mostrar-invitaciones',compact('invitaciones'));
    }

    #[On('nuevaInvitacion')]
    public function nuevoInvitacion()
    {
        $this->reset('invitacion_id','nombre','telefono','email','pases');
        $this->resetValidation();
        $this->pases = 1;
        $this->dispatch('open-modal', 'ModalInvitacion');
    }

    #[On('consultarInvitacion')]
    public function consultarInvitacion(Invitacion $invitacion)
    {
        $this->resetValidation();
        $this->reset('invitacion_id','nombre','telefono','email','pases');
        $this->invitacion_id = $invitacion->id;
        $this->nombre = $invitacion->nombre;
        $this->telefono = $invitacion->telefono;
        $this->email = $invitacion->email;
        $this->pases = $invitacion->pases;
        $this->dispatch('open-modal', 'ModalInvitacion');
    }

    public function formInvitacion()
    {
        $datos = $this->validate();
        try {
            if(!$this->invitacion_id)
            {   $this->crearInvitacion($datos);   }
            else
            {   $this->editarInvitacion($datos);  }
            $this->dispatch('notify', type:'success',title: 'Invitación guardada exitosamente');
            $this->dispatch('close-modal');
        } catch (\Throwable $th) {
            dd($th);
            $this->dispatch('notify', type:'error',title: 'Error al guardar el invitación');
        }
        return redirect()->back();
    }

    public function crearInvitacion($datos)
    {
        Invitacion::create([
            'evento_id'             =>  $this->evento_id,
            'nombre'                =>  $datos['nombre'],
            'telefono'              =>  $datos['telefono'],
            'email'                 =>  $datos['email'],
            'pases'                 =>  $datos['pases'],
            'estatus_invitacion_id' =>  1,//Estatus de pendiente
            'codigo'                =>  Str::uuid()
        ]);
    }

    public function editarInvitacion($datos)
    {
        $Invitacion = Invitacion::find($this->invitacion_id);
        $Invitacion->nombre     = $datos['nombre'];
        $Invitacion->telefono   = $datos['telefono'];
        $Invitacion->email      = $datos['email'];
        $Invitacion->pases      = $datos['pases'];
        $Invitacion->save();
    }

    #[On('eliminarInvitacion')]
    public function eliminarInvitacion(Invitacion $invitacion)
    {
        try {
            $invitacion->delete();
            $this->dispatch('notify', type:'success',title: 'La invitación fue eliminada correctamente');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al eliminar la invitación');
        }
    }
}
