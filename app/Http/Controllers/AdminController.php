<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carta;
use App\Models\Categoria;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el orden para usuarios y categorías
        $ordenUsuarios = $request->input('orden_usuarios', 'asc'); // Por defecto ascendente
        $ordenCategorias = $request->input('orden_categorias', 'asc'); // Por defecto ascendente
    
        // Obtener usuarios con filtrado y ordenación
        $usuarios = User::query()
            ->when($request->input('nombre'), function ($query, $nombre) {
                $query->where('name', 'like', "%{$nombre}%");
            })
            ->when($request->input('numTelf'), function ($query, $numTelf) {
                $query->where('numTelf', 'like', "%{$numTelf}%");
            })
            ->orderBy('name', $ordenUsuarios) // Aseguramos que se ordene correctamente
            ->get();
    
        // Obtener categorías con filtrado y ordenación
        $categorias = Categoria::query()
            ->when($request->input('nombre_categoria'), function ($query, $nombre) {
                $query->where('nombre', 'like', "%{$nombre}%");
            })
            ->orderBy('nombre', $ordenCategorias)
            ->get();
    
        return view('admin.index', compact('usuarios', 'categorias', 'ordenUsuarios', 'ordenCategorias'));
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->back()->with('success', 'Carta eliminada correctamente.');
    }
    public function adminCartas()
    {
        
        $cartas = Carta::all(); // Todas las cartas del sistema
        return view('cartas.admin', compact('cartas'));
    }

    public function edit($id, Request $request)
    {
        $usuario = User::findOrFail($id);

        $query = $usuario->cartas();

        // Filtro por nombre
        if ($request->has('search') && $request->search != '') {
            $query->where('nombre_carta_api', 'like', '%' . $request->search . '%');
        }

        // Ordenación
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('nombre_carta_api', $request->sort);
        }

        $cartas = $query->get();

        return view('admin.editUser', compact('usuario', 'cartas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
        ]);

        $usuario = User::findOrFail($id);
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'numTelf' => $request->numTelf,
        ]);

        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
    }
    public function misCartas(Request $request)
    {
        $query = $request->input('query');
        $orden = $request->input('orden');

        $cartas = Carta::query();

        // Solo buscar por nombre
        if ($query) {
            $cartas->where('nombre_carta_api', 'like', "%$query%");
        }

        // Ordenar por precio si se indica
        if ($orden === 'asc') {
            $cartas->orderBy('precio', 'asc');
        } elseif ($orden === 'desc') {
            $cartas->orderBy('precio', 'desc');
        }

        $cartas = $cartas->get();

        return view('cartas.mis', compact('cartas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'contraseña' => 'required|min:6'
        ],[
            'contraseña.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);
        

        User::create([
            'name' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('contraseña')),
            'direccion' => $request->input('direccion'),
            'numTelf' => $request->input('numTelf'),
            'admin' => $request->has('admin') ? 1 : 0,
        ]);
        

        return redirect()->route('admin.index')->with('success', 'Usuario creado correctamente.');
    }
}

