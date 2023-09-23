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
        $exito = 0;
        
        if(!$this->contacto_id)
        {
            $exito = $this->crearContacto($datos);
        }
        else
        {
            $exito = $this->editarContacto($datos);
        }
        if($exito)
        { session()->flash('success','Contacto guardado exitosamente');}
        else{session()->flash('error','Error al guardar el contacto');}
        $this->dispatch('close-modal');
        return redirect()->back();
    }

    public function crearContacto($datos)
    {
        return Contacto::create([
            'evento_id' =>  $this->evento_id,
            'nombre'    =>  $datos['nombre'],
            'telefono'  =>  $datos['telefono'],
        ]);
    } 

    public function editarContacto($datos)
    {
        // dd( $datos['fecha']);
        $Contacto = Contacto::find($this->contacto_id);
        $Contacto->nombre = $datos['nombre'];
        $Contacto->telefono = $datos['telefono'];
        return $Contacto->save();
    }

    #[On('eliminarContacto')]
    public function eliminarContacto(Contacto $contacto)
    {
        $contacto->delete();
    }
}
