<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function showRegistrationForm()
    {
        return view('user.register'); // ✅ Correcto según tu estructura
    }

    /**
     * Registra un nuevo usuario.
     */
    public function register(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'username'    => 'required|string|max:255|unique:users,username',
            'password'    => 'required|string|min:6|confirmed',
            'email'       => 'required|email|max:255|unique:users,email',
            'address'     => 'required|string|max:255',
        ]);

        // Crear el usuario
        $user = User::create([
            'username'    => $request->username,
            'password'    => Hash::make($request->password),
            'email'       => $request->email,
            'address'     => $request->address,
        ]);

        // Disparar el evento de registro
        event(new Registered($user));

        // Autenticar al usuario
        auth()->login($user);

        // Redireccionar a dashboard o donde desees
        return redirect()->route('home');
    }
}
