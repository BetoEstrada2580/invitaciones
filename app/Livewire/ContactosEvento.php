<?php

namespace App\Livewire;

use App\Models\Contacto;
use App\Models\Evento;
use Livewire\Attributes\On;
use Livewire\Component;

class ContactosEvento extends Component
{
    public $evento_id;
    public $contacto_id;
    public $nombre;
    public $telefono;

    protected function rules()
    {
        return [
            'nombre'    => ['required','string','max:255'],
            'telefono'  => ['required', 'numeric','digits:10'],
        ];
    }

    public function mount(Evento $evento){
        $this->evento_id = $evento->id;
    }
    
    public function render()
    {
        $contactos = Contacto::all();
        return view('livewire.contactos-evento',compact('contactos'));
    }

    #[On('nuevoContacto')]
    public function nuevoContacto()
    {
        $evento_id= $this->evento_id;
        $this->reset();
        $this->evento_id = $evento_id;
        $this->resetValidation();
        $this->dispatch('open-modal', 'ModalContacto');
    }

    #[On('consultarContacto')]
    public function consultarContacto(Contacto $contacto)
    {
        $evento_id= $this->evento_id;
        $this->resetValidation();
        $this->reset();
        $this->evento_id = $evento_id;
        $this->contacto_id = $contacto->id;
        $this->nombre = $contacto->nombre;
        $this->telefono = $contacto->telefono;
        $this->dispatch('open-modal', 'ModalContacto');
    }

    public function formContacto()
    {
        $datos = $this->validate();
        try {
            if(!$this->contacto_id)
            {   $this->crearContacto($datos);   }
            else
            {   $this->editarContacto($datos);  }
            $this->dispatch('notify', type:'success',title: 'Contacto guardado exitosamente');
            $this->dispatch('close-modal');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al guardar el contacto');
        }
        return redirect()->back();
    }

    public function crearContacto($datos)
    {
        Contacto::create([
            'evento_id' =>  $this->evento_id,
            'nombre'    =>  $datos['nombre'],
            'telefono'  =>  $datos['telefono'],
        ]);
    } 

    public function editarContacto($datos)
    {
        $Contacto = Contacto::find($this->contacto_id);
        $Contacto->nombre = $datos['nombre'];
        $Contacto->telefono = $datos['telefono'];
        $Contacto->save();
    }

    #[On('eliminarContacto')]
    public function eliminarContacto(Contacto $contacto)
    {
        try {
            $contacto->delete();
            $this->dispatch('notify', type:'success',title: 'El contacto eliminado correctamente');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al eliminar el contacto');
        }
    }
}
