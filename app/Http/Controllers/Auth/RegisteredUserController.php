<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Notifications\NuevoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'rol_id' => ['required', 'numeric', 'between:1,3'],
            // 'password' => ['required', 'confirmed'],
        ]);
        
        $newPassoword = Str::random(10);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rol_id' => $request->rol_id,
            'password' => Hash::make($newPassoword),
        ]);
        
        // event(new Registered($user));

        $user->notify(new NuevoUsuario($newPassoword));

        session()->flash('success','Usuario creado exitosamente');

        return redirect(RouteServiceProvider::HOME);
    }
}
