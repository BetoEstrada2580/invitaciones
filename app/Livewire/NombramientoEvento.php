<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Imagen;
use App\Models\Invitacion;
use App\Models\Nombramiento;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

// #[Lazy]
class NombramientoEvento extends Component
{
    use WithFileUploads;

    public $evento_id;
    public $nombramiento_id;
    public $invitacion_id;
    public $titulo;
    public $imagen;
    public $imagen_actual;
    public $orden;

    protected function rules()
    {
        return [
            'invitacion_id' => ['required','numeric','unique:nombramientos,invitacion_id,'.$this->nombramiento_id],
            'titulo'        => ['required', 'string','max:50'],
            'imagen'        => [$this->nombramiento_id ? 'nullable' :'required','image','max:1024'],
            'orden'         => ['nullable','numeric'],
        ];
    }

    public function mount(Evento $evento){
        $this->evento_id = $evento->id;
    }

    public function render()
    {  
        $listado = Nombramiento::pluck('invitacion_id');
        $invitados = Invitacion::where('evento_id',$this->evento_id)->whereNotIn('id',$listado)->orderBy('nombre', 'ASC')->get();
        $nombramientos = Nombramiento::where('evento_id',$this->evento_id)->orderBy('orden')->get();
        return view('livewire.nombramiento-evento',compact('invitados','nombramientos'));
    }

    #[On('nuevoNombramiento')]
    public function nuevoNombramiento()
    {
        $evento_id= $this->evento_id;
        $this->reset();
        $this->evento_id = $evento_id;
        $this->resetValidation();
        $this->dispatch('open-modal', 'ModalNombramiento');
    }

    #[On('consultarNombramiento')]
    public function consultarNombramiento(Nombramiento $nombramiento)
    {
        $evento_id= $this->evento_id;
        $this->resetValidation();
        $this->reset();
        $this->evento_id = $evento_id;
        $this->nombramiento_id = $nombramiento->id;
        $this->invitacion_id = $nombramiento->invitacion_id;
        $this->titulo = $nombramiento->titulo;
        $this->imagen_actual = $nombramiento->imagen->url;
        $this->orden = $nombramiento->orden;
        $this->dispatch('open-modal', 'ModalNombramiento');
    }

    public function formNombramiento()
    {
        $datos = $this->validate();
        try {
            if(!$this->nombramiento_id)
            {   $this->crearNombramiento($datos);   }
            else
            {   $this->editarNombramiento($datos);  }
            $this->dispatch('notify', type:'success',title: 'Nombramiento guardado exitosamente');
            $this->dispatch('close-modal');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al guardar el nombramiento');
        }
        return redirect()->back();
    }

    public function crearNombramiento($datos)
    {
        //* Almacenar la imagen
        $imagen = $this->imagen->store('public/nombramientos');
        $filename = str_replace('public/nombramientos/','',$imagen);
        $nuevaImagen = Imagen::create([
            'evento_id'         =>  $this->evento_id,
            'tipo_imagen_id'    =>  1, //Nombramiento
            'url'               =>  $filename,
        ]);
        Nombramiento::create([
            'evento_id'     =>  $this->evento_id,
            'invitacion_id' =>  $datos['invitacion_id'],
            'titulo'        =>  $datos['titulo'],
            'imagen_id'     =>  $nuevaImagen->id,
            'orden'         =>  $datos['orden'],
        ]);
    }

    public function editarNombramiento($datos)
    {
        $nombramiento = Nombramiento::find($this->nombramiento_id);
        $imagenNombramiento = Imagen::find($nombramiento->imagen_id);
        if($this->imagen){
            $imagen = $this->imagen->store('public/nombramientos');
            $filename = str_replace('public/nombramientos/','',$imagen);
            Storage::delete('public/nombramientos/'.$imagenNombramiento->url);
            $imagenNombramiento->url = $filename;
            $imagenNombramiento->save();
        }
        $nombramiento->invitacion_id    = $datos['invitacion_id'];
        $nombramiento->titulo           = $datos['titulo'];
        $nombramiento->orden            = $datos['orden'];
        $nombramiento->save();
    }

    #[On('eliminarNombramiento')]
    public function eliminarNombramiento(Nombramiento $nombramiento)
    {
        try {
            $imagenNombramiento = Imagen::find($nombramiento->imagen_id);
            Storage::delete('public/nombramientos/'.$imagenNombramiento->url);
            $imagenNombramiento->delete();
            $nombramiento->delete();
            $this->dispatch('notify', type:'success',title: 'El nombramiento se ha eliminado correctamente');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al eliminar el nombramiento');
        }
    }
}
