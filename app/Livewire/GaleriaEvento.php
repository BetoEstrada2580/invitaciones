<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Galeria;
use App\Models\Imagen;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

// #[Lazy]
class GaleriaEvento extends Component
{
    use WithFileUploads;

    public $evento_id;
    public $galeria_id;
    public $imagen;
    public $imagen_actual;
    public $orden;

    protected function rules()
    {
        return [
            'imagen'    => [$this->galeria_id ? 'nullable' :'required','image','max:1024'],
            'orden'     => ['required','numeric'],
        ];
    }

    public function mount(Evento $evento){
        $this->evento_id = $evento->id;
    }

    public function render()
    {
        $galerias = Galeria::where('evento_id',$this->evento_id)->get();
        return view('livewire.galeria-evento',compact('galerias'));
    }

    #[On('nuevaGaleria')]
    public function nuevaGaleria()
    {
        $evento_id= $this->evento_id;
        $this->reset();
        $this->evento_id = $evento_id;
        $this->resetValidation();
        $this->dispatch('open-modal', 'ModalGaleria');
    }

    #[On('consultarGaleria')]
    public function consultarGaleria(Galeria $galeria)
    {
        $evento_id= $this->evento_id;
        $this->resetValidation();
        $this->reset();
        $this->evento_id = $evento_id;
        $this->galeria_id = $galeria->id;
        $this->orden = $galeria->orden;
        $this->imagen_actual = $galeria->imagen->url;
        $this->dispatch('open-modal', 'ModalGaleria');
    }

    public function formGaleria()
    {
        $datos = $this->validate();
        $exito = 0;
        
        if(!$this->galeria_id)
        {
            $exito = $this->crearGaleria($datos);
        }
        else
        {
            $exito = $this->editarGaleria($datos);
        }
        if($exito)
        { session()->flash('success','Imagen de galeria guardada exitosamente');}
        else{session()->flash('error','Error al guardar la imagen de la galeria');}
        $this->dispatch('close-modal');
        return redirect()->back();
    }

    public function crearGaleria($datos)
    {
        //* Almacenar la imagen
        $imagen = $this->imagen->store('public/galerias');
        $filename = str_replace('public/galerias/','',$imagen);

        $nuevaImagen = Imagen::create([
            'evento_id'         =>  $this->evento_id,
            'tipo_imagen_id'    =>  5, //Galeria
            'url'               =>  $filename,
        ]);

        return Galeria::create([
            'evento_id'     =>  $this->evento_id,
            'imagen_id'     =>  $nuevaImagen->id,
            'orden'         =>  $datos['orden'],
        ]);
    } 

    public function editarGaleria($datos)
    {
        $Galeria = Galeria::find($this->galeria_id);
        $imagenGaleria = Imagen::find($Galeria->imagen_id);

        if($this->imagen){
            $imagen = $this->imagen->store('public/galerias');
            $filename = str_replace('public/galerias/','',$imagen);
            Storage::delete('public/galerias/'.$imagenGaleria->url);
        }
        
        $imagenGaleria->url = $filename;
        $imagenGaleria->save();
        $Galeria->orden = $datos['orden'];
        return $Galeria->save();
    }

    #[On('eliminarGaleria')]
    public function eliminarGaleria(Galeria $galeria)
    {
        $imagenGaleria = Imagen::find($galeria->imagen_id);
        Storage::delete('public/galerias/'.$imagenGaleria->url);
        $imagenGaleria->delete();
        $galeria->delete();
    }
    
}
