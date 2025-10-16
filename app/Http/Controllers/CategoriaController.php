<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Carta;
use Illuminate\Support\Facades\Http;

class CategoriaController extends Controller
{
    // Vista pública para los usuarios normales
    public function showPublic()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);

        $cartasSeleccionadas = collect();

        if (!empty($categoria->id_carta)) {
            $ids = explode(',', $categoria->id_carta);
            $cartas = Carta::whereIn('id_carta_api', $ids)->get();

            // Aquí enriquecemos las cartas con los datos de la API
            $cartasSeleccionadas = $this->obtenerInfoDesdeApi($cartas);
        }

        return view('categorias.show', compact('categoria', 'cartasSeleccionadas'));
    }

    private function obtenerInfoDesdeApi($cartas)
    {
        return $cartas->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();

            return [
                'id' => $carta->id,
                'id_carta_api' => $idApi,
                'nombre' => $datosApi['data']['name'] ?? 'Desconocido',
                'imagen' => $datosApi['data']['images']['small'] ?? asset('imagenes/default-card.png'),
                'expansion_api_id' => $datosApi['data']['set']['id'] ?? null,
                'expansion_api_name' => $datosApi['data']['set']['name'] ?? null,
            ];
        });
    }

    // Vista solo para administradores
    public function adminIndex()
    {
        $categorias = Categoria::all();
        return view('admin.categorias', compact('categorias'));
    }

    // Formulario de creación (solo admin)
    public function create()
    {
        return view('admin.createCat');
    }

    // Formulario de creación para usuario normal (si quieres permitirlo)
    public function createPublic()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        // Crear la categoría
        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        // Redirigir a la lista de categorías con mensaje de éxito (opcional)
        return redirect()->route('categorias.index')
                        ->with('success', 'Categoría creada correctamente.');
    }


    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.editCat', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.categorias')->with('success', 'Categoría actualizada');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->back()->with('success', 'Categoría eliminada');
    }

    // Mostrar una categoría concreta
    public function showCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }

    public function editCartas($id)
    {
        $categoria = Categoria::findOrFail($id);
        $cartas = Carta::all();

        $cartasEnriquecidas = $this->obtenerInfoDesdeApi($cartas);

        $cartas = $cartasEnriquecidas;

        return view('categorias.select_cartas', compact('categoria', 'cartas'));
    }


    public function updateCartas(Request $request, $id)
    {
        $request->validate([
            'id_carta' => 'required|array|min:1',
        ], [
            'id_carta.required' => 'Debes seleccionar al menos una carta.',
            'id_carta.min' => 'Debes seleccionar al menos una carta.',
        ]);

        $categoria = Categoria::findOrFail($id);

        // Extraer las cartas actuales y convertirlas a array
        $cartasActuales = $categoria->id_carta ? explode(',', $categoria->id_carta) : [];

        // Obtener las nuevas seleccionadas del request
        $cartasNuevas = $request->input('id_carta', []);

        // Combinar y quitar duplicados
        $todasCartas = array_unique(array_merge($cartasActuales, $cartasNuevas));

        // Guardar como string separado por comas
        $categoria->id_carta = implode(',', $todasCartas);
        $categoria->save();

        return redirect()->route('categorias.show', $id)->with('success', 'Cartas actualizadas correctamente.');
    }
}