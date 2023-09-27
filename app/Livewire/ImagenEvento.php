<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Imagen;
use App\Models\Tipo_imagen;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImagenEvento extends Component
{
    use WithFileUploads;

    public $evento_id;
    public $imagen_id;
    #[Rule(['required','numeric'], as: 'tipo de imagen')]
    public $tipo_imagen_id;
    public $imagen;
    public $imagen_actual;

    protected function rules()
    {
        return [
            'imagen'    => [$this->imagen_id ? 'nullable' :'required','image','max:1024'],
            'tipo_imagen_id'     => ['required','numeric'],
        ];
    }

    public function mount(Evento $evento){
        $this->evento_id = $evento->id;
    }

    public function render()
    {
        $principales = Imagen::where('evento_id',$this->evento_id)->Where('tipo_imagen_id','>','1')->Where('tipo_imagen_id','<','5')->get();
        $tipoImagenes = Tipo_imagen::where('id','>','1')->where('id','<','5')->get();
        return view('livewire.imagen-evento',compact('principales','tipoImagenes'));
    }

    #[On('nuevaImagen')]
    public function nuevaImagen()
    {
        $evento_id= $this->evento_id;
        $this->reset();
        $this->evento_id = $evento_id;
        $this->resetValidation();
        $this->dispatch('open-modal', 'ModalImagen');
    }

    #[On('consultarImagen')]
    public function consultarImagen(Imagen $imagen)
    {
        $evento_id= $this->evento_id;
        $this->resetValidation();
        $this->reset();
        $this->evento_id = $evento_id;
        $this->imagen_id = $imagen->id;
        $this->tipo_imagen_id = $imagen->tipo_imagen_id;
        $this->imagen_actual = $imagen->url;
        $this->dispatch('open-modal', 'ModalImagen');
    }

    public function formImagen()
    {
        $datos = $this->validate();
        $exito = 0;
        
        if(!$this->imagen_id)
        {
            $exito = $this->crearImagen($datos);
        }
        else
        {
            $exito = $this->editarImagen($datos);
        }
        if($exito)
        { session()->flash('success','Imagen del evento guardada exitosamente');}
        else{session()->flash('error','Error al guardar la imagen del evento');}
        $this->dispatch('close-modal');
        return redirect()->back();
    }

    public function crearImagen($datos)
    {
        $imagen = $this->imagen->store('public/eventos');
        $filename = str_replace('public/eventos/','',$imagen);

        return Imagen::create([
            'evento_id'         =>  $this->evento_id,
            'tipo_imagen_id'    =>  $datos['tipo_imagen_id'],
            'url'               =>  $filename,
        ]);
    } 

    public function editarImagen($datos)
    {
        $Imagen = Imagen::find($this->imagen_id);

        if($this->imagen){
            $imagen = $this->imagen->store('public/eventos');
            $filename = str_replace('public/eventos/','',$imagen);
            Storage::delete('public/eventos/'.$Imagen->url);
            $Imagen->url = $filename;
        }
        $Imagen->tipo_imagen_id = $datos['tipo_imagen_id'];

        return $Imagen->save();
    }

    #[On('eliminarImagen')]
    public function eliminarImagen(Imagen $imagen)
    {
        Storage::delete('public/eventos/'.$imagen->url);
        $imagen->delete();
    }

}
