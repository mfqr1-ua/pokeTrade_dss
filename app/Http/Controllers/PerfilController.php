<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil');
    }

    public function actualizarContraseña(Request $request){
        $request->validate([
            'actual' => 'required|string|min:8',
            'nueva' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->actual, Auth::user()->password)) {
            return back()->withErrors(['actual' => 'Contraseña actual incorrecta.']);
        }

        Auth::user()->update(['password' => Hash::make($request->nueva)]);
        return back()->with('status', 'Contraseña actualizada');
    }


    public function actualizarUsuario(Request $request) {
        $request->validate([
            'nuevo_usuario' => 'required|string|min:3|max:255',
            'password' => 'required|string',
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'La contraseña no es correcta.']);
        }

        Auth::user()->update(['name' => $request->nuevo_usuario]);
        return back()->with('status', 'Usuario actualizado');
    }



    public function actualizarDireccion(Request $request) {
        $request->validate([
            'calle' => 'required|string|max:255',
            'numero' => 'required|string|regex:/^\d+$/|max:10',
            'piso' => 'nullable|string|max:50',
            'cpp' => 'required|string|regex:/^\d+$/|max:20',
            'localidad' => 'required|string|max:100',
            'pais' => 'required|string|max:100',
        ], [
            'numero.regex' => 'El número solo puede contener dígitos.',
            'cpp.regex' => 'El código postal solo puede contener dígitos.',
        ]);

        // Construcción del string de dirección
        $direccion = $request->calle . ' ' . $request->numero;
        if ($request->filled('piso')) {
            $direccion .= ', ' . $request->piso;
        }
        $direccion .= ', ' . $request->cpp . ', ' . $request->localidad . ', ' . $request->pais;

        // Guardar en el usuario autenticado
        $user = auth()->user();
        $user->direccion = $direccion;
        $user->save();

        return back()->with('success', 'Dirección actualizada');
    }

    public function actualizarFoto(Request $request) {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $usuario = Auth::user();

        // Borrar la foto anterior si no es la por defecto
        if ($usuario->foto && \Storage::disk('public')->exists($usuario->foto)) {
            \Storage::disk('public')->delete($usuario->foto);
        }

        // Guardar la nueva
        $path = $request->file('foto')->store('perfiles', 'public');
        $usuario->update(['foto' => $path]);

        return back()->with('success', 'Foto de perfil actualizada correctamente.');
    }
}
