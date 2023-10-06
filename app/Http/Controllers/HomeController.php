<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if(auth()->user()->rol_id === 1)
            return redirect()->route('evento.index');
        
        return view('dashboard');

    }
}
