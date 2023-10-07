<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Invitacion;
use Illuminate\Http\Request;

class InvitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Evento::where('user_id',auth()->user()->id)->get();
        $eventosCount = $eventos->count();
        if($eventosCount == 1)
            return redirect()->route('invitacion.show',['eventos' => $eventos[0]->id]);
        
        return redirect()->route('invitacion.eventos');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        $invitaciones = Invitacion::where('evento_id',$evento->id)->paginate(10);;
        return view('clientes.invitaciones',compact('invitaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function eventos()
    {
        $eventos = Evento::where('user_id',auth()->user()->id)->paginate(10);
        return view('clientes.eventos',compact('eventos'));
    }
}
