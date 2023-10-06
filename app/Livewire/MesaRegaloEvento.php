<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Mesa_regalo;
use App\Models\Tipo_mesa_regalo;
use Livewire\Attributes\On;
use Livewire\Component;

class MesaRegaloEvento extends Component
{
    public $evento_id;
    public $mesa_regalo_id;
    public $tipo_mesa_regalo_id;
    public $codigo;
    public $url;
    public $banco;
    public $clabe;

    protected function rules()
    {
        return [
            'tipo_mesa_regalo_id'  => ['required', 'numeric'],
            'codigo'    => ['nullable','string','max:20'],
            'url'    => ['nullable','string','max:255'],
            'banco'    => ['nullable','string','max:50'],
            'clabe'    => ['nullable','string','max:18'],
        ];
    }

    public function mount(Evento $evento){
        $this->evento_id = $evento->id;
    }
    
    public function render()
    {
        $regalos = Mesa_regalo::where('evento_id',$this->evento_id)->orderBy('tipo_mesa_regalo_id')->get();
        $tipoMesaRegalos = Tipo_mesa_regalo::all();
        return view('livewire.mesa-regalo-evento',compact('regalos','tipoMesaRegalos'));
    }

    #[On('nuevaMesaRegalo')]
    public function nuevaMesaRegalo()
    {
        $evento_id= $this->evento_id;
        $this->reset();
        $this->evento_id = $evento_id;
        $this->resetValidation();
        $this->dispatch('open-modal', 'ModalMesaRegalo');
    }

    #[On('consultarMesaRegalo')]
    public function consultarMesaRegalo(Mesa_regalo $MesaRegalo)
    {
        $evento_id= $this->evento_id;
        $this->resetValidation();
        $this->reset();
        $this->evento_id = $evento_id;
        $this->mesa_regalo_id = $MesaRegalo->id;
        $this->tipo_mesa_regalo_id = $MesaRegalo->tipo_mesa_regalo_id;
        $this->codigo = $MesaRegalo->codigo;
        $this->url = $MesaRegalo->url;
        $this->banco = $MesaRegalo->banco;
        $this->clabe = $MesaRegalo->clabe;

        $this->dispatch('open-modal', 'ModalMesaRegalo');
    }

    public function formMesaRegalo()
    {
        $datos = $this->validate();
        
        try {
            if(!$this->mesa_regalo_id)
            {   $this->crearMesaRegalo($datos); }
            else
            {   $this->editarMesaRegalo($datos); }
            $this->dispatch('notify', type:'success',title: 'Opción de regalo guardada exitosamente');
            $this->dispatch('close-modal');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al guardar la opción de regalo');
        }
        return redirect()->back();
    }

    public function crearMesaRegalo($datos)
    {
        Mesa_regalo::create([
            'evento_id'             =>  $this->evento_id,
            'tipo_mesa_regalo_id'   =>  $datos['tipo_mesa_regalo_id'],
            'codigo'                =>  $datos['codigo'],
            'url'                   =>  $datos['url'],
            'banco'                 =>  $datos['banco'],
            'clabe'                 =>  $datos['clabe'],
        ]);
    } 

    public function editarMesaRegalo($datos)
    {
        $MesaRegalo = Mesa_regalo::find($this->mesa_regalo_id);
        $MesaRegalo->tipo_mesa_regalo_id = $datos['tipo_mesa_regalo_id'];
        $MesaRegalo->codigo = $datos['codigo'];
        $MesaRegalo->url = $datos['url'];
        $MesaRegalo->banco = $datos['banco'];
        $MesaRegalo->clabe = $datos['clabe'];
        $MesaRegalo->save();
    }

    #[On('eliminarMesaRegalo')]
    public function eliminarMesaRegalo(Mesa_regalo $MesaRegalo)
    {
        try {
            $MesaRegalo->delete();
            $this->dispatch('notify', type:'success',title: 'La opción de regalo se ha eliminado correctamente');
        } catch (\Throwable $th) {
            $this->dispatch('notify', type:'error',title: 'Error al eliminar la opción de regalo');
        }
    }
}
