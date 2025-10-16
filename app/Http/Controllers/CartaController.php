<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Carta;

use App\Models\CestaItem;


class CartaController extends Controller
{
    //
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $cartasNombre = [];
        $cartasTipo = [];
    
        // Buscar por nombre (nombre exacto o parcial)
        $responseNombre = Http::get("https://api.pokemontcg.io/v2/cards?q=name:$query");
        if ($responseNombre->successful()) {
            $cartasNombre = $responseNombre->json()['data'];
        }
    
        // Buscar por tipo (por ejemplo "Fire", "Water", "Grass"...)
        $responseTipo = Http::get("https://api.pokemontcg.io/v2/cards?q=types:$query");
        if ($responseTipo->successful()) {
            $cartasTipo = $responseTipo->json()['data'];
        }
    
        // Unir ambos resultados y eliminar duplicados por ID
        $todasCartas = collect($cartasNombre)
                        ->merge($cartasTipo)
                        ->unique('id')
                        ->values();
    
        return view('cartas.buscar', ['cartas' => $todasCartas]);
    }
    // Mostrar el formulario para crear la carta seleccionada
    public function create(Request $request)
    {
        $nombre_carta_api = $request->get('nombre_carta_api');
        $id_carta_api = $request->get('id_carta_api');

        // Obtener expansion_api_id desde la API si no viene en la request
        $expansion_api_id = $request->get('expansion_api_id');
        if (!$expansion_api_id && $id_carta_api) {
            $response = Http::get("https://api.pokemontcg.io/v2/cards/{$id_carta_api}");
            if ($response->successful()) {
                $expansion_api_id = $response['data']['set']['id'] ?? '';
            }
        }

        return view('cartas.crear', compact('nombre_carta_api', 'id_carta_api', 'expansion_api_id'));
    }

    public function cartasPorExpansion($expansion_id)
    {
        // Tus cartas del usuario actual
        $cartas = Carta::where('usuario_id', auth()->id())
                    ->where('expansion_api_id', $expansion_id)
                    ->get();

        // Nombre de la expansión
        $expansion_name = null;
        if ($cartas->isNotEmpty()) {
            $firstCarta = $cartas->first();
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$firstCarta->id_carta_api}");
            if ($apiResponse->successful()) {
                $data = $apiResponse->json();
                $expansion_name = $data['data']['set']['name'] ?? null;
            }
        }

        // Obtener TODAS las cartas de la expansión desde la API externa
        $cartas_expansion_completa = [];
        $response = Http::get("https://api.pokemontcg.io/v2/cards", [
            'q' => 'set.id:' . $expansion_id,
            'pageSize' => 30
        ]);

        if ($response->successful()) {
            $cartas_expansion_completa = $response->json()['data'] ?? [];
        }

        return view('expansiones.cartas', [
            'cartas' => $cartas,
            'expansion_id' => $expansion_id,
            'expansion_name' => $expansion_name,
            'cartas_expansion_completa' => $cartas_expansion_completa
        ]);
    }

    public function misCartas()
    {
        $usuario_id = 1; // o el ID del usuario autenticado
        $cartas = \App\Models\Carta::where('usuario_id', auth()->id())->get();
    
        $cartasConInfo = $cartas->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();
    
            return [
                'id' => $carta->id, // IMPORTANTE: este es el id para eliminar
                'id_carta_api' => $idApi,
                'nombre' => $datosApi['data']['name'] ?? 'Desconocido',
                'imagen' => $datosApi['data']['images']['small'] ?? null,
                'rareza' => $carta->rareza,
                'estado' => $carta->estado,
                'precio' => $carta->precio,
                'fecha_adquisicion' => $carta->fecha_adquisicion,
            ];
        });
    
        return view('cartas.mis', ['cartas' => $cartasConInfo]);
    }

    public function inicio()
    {
        // Obtener cartas de la base de datos barajadas
        $cartasDB = Carta::all()->shuffle();

        // Conseguir 7 cartas únicas para Trending
        $cartasTrending = collect();
        $idsAgregados = [];

        foreach ($cartasDB as $carta) {
            if (!in_array($carta->id_carta_api, $idsAgregados)) {
                $cartasTrending->push($carta);
                $idsAgregados[] = $carta->id_carta_api;
            }
            if ($cartasTrending->count() == 7) break;
        }

        // Conseguir 4 cartas únicas para Catálogo (también evitando duplicados internos)
        $cartasCatalogo = collect();
        $idsCatalogo = [];

        foreach ($cartasDB as $carta) {
            if (!in_array($carta->id_carta_api, $idsCatalogo)) {
                $cartasCatalogo->push($carta);
                $idsCatalogo[] = $carta->id_carta_api;
            }
            if ($cartasCatalogo->count() == 4) break;
        }

        // Obtener datos de la API para cada bloque
        $cartasTrending = $this->obtenerInfoDesdeApi($cartasTrending);
        $cartasCatalogo = $this->obtenerInfoDesdeApi($cartasCatalogo);

        return view('home.inicio', compact('cartasTrending', 'cartasCatalogo'));
    }

    public function catalogo(Request $request)
    {
        $expansion = $request->query('expansion');

        if ($expansion) {
            // Obtener cartas de la expansión especificada desde la API
            $response = Http::get("https://api.pokemontcg.io/v2/cards", [
                'q' => 'set.name:"' . $expansion . '"',
                'pageSize' => 14,
            ]);

            if ($response->successful()) {
                $cartas = collect($response->json()['data']);
            } else {
                $cartas = [];
            }

            return view('catalogo.catalogo', [
                'cartas' => $cartas,
                'expansion' => $expansion,
            ]);
        } else {
            // Lógica existente para mostrar el catálogo sin filtro
            $cartasOriginales = Carta::select('id_carta_api')
                ->distinct()
                ->paginate(14);

            $cartasConImagenes = $cartasOriginales->map(function ($carta) {
                $idApi = $carta->id_carta_api;
                $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
                $datosApi = $apiResponse->json();

                return [
                    'id' => $idApi,
                    'imagen' => $datosApi['data']['images']['small'] ?? asset('imagenes/default-card.png'),
                ];
            });

            return view('catalogo.catalogo', [
                'cartas' => $cartasConImagenes,
                'cartasOriginales' => $cartasOriginales,
            ]);
        }
    }



    private function obtenerInfoDesdeApi($cartas)
    {
        return $cartas->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();

            return [
                'id' => $carta->id,
                'nombre' => $datosApi['data']['name'] ?? 'Desconocido',
                'imagen' => $datosApi['data']['images']['small'] ?? asset('imagenes/default-card.png'),
                'expansion_api_id' => $datosApi['data']['set']['id'] ?? null,
            'expansion_api_name' => $datosApi['data']['set']['name'] ?? null,
            ];
        });
    }
    
   public function adminCartas()
    {
        // Opcional: puedes añadir verificación de rol si tu sistema lo soporta
        $cartas = Carta::with('usuario')->get();
        return view('cartas.admin', compact('cartas'));
    }


    public function edit($id)
    {
        $carta = Carta::findOrFail($id);

        // Guardamos en sesión la URL desde la que venimos
        session(['previous_url' => url()->previous()]);

        return view('cartas.editCarta', compact('carta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rareza'            => 'required|string',
            'estado'            => 'required|string',
            'precio'            => 'required|numeric',
            'fecha_adquisicion' => 'required|date',
        ]);

        $carta = Carta::findOrFail($id);
        $carta->update($request->only([
            'rareza', 'estado', 'precio', 'fecha_adquisicion'
        ]));

        // Recuperamos la URL que guardamos en edit(),
        // o caemos en la ruta 'cartas.mis' si no existe.
        $urlAnterior = session('previous_url', route('cartas.mis'));

        // Opcional: limpiamos la clave de sesión
        session()->forget('previous_url');

        return redirect($urlAnterior)
               ->with('success', 'Carta actualizada correctamente.');
    }

    // Mostrar formulario admin
    public function editAdmin($id)
    {
        $carta = Carta::findOrFail($id);
        session(['admin_previous_url' => url()->previous()]);
        return view('admin.editCarta', compact('carta'));
    }

    // Guardar cambios
    public function updateAdmin(Request $request, $id)
    {
        $carta = Carta::findOrFail($id);

        $carta->rareza = $request->input('rareza');
        $carta->estado = $request->input('estado');
        $carta->precio = $request->input('precio');
        $carta->fecha_adquisicion = $request->input('fecha_adquisicion');
        $carta->save();

        // híbrido: Laravel te guarda automáticamente la URL anterior en la sesión
        $urlAnterior = session('admin_previous_url', route('admin.index'));
        return redirect($urlAnterior)
                ->with('success', '¡Carta actualizada correctamente!');

    }

    public function store(Request $request)
    {
        // Validar datos del formulario
        $request->validate([
            'id_carta_api' => 'required|string',
            'nombre_carta_api' => 'required|string',
            'rareza' => 'required|string',
            'estado' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'fecha_adquisicion' => 'required|date',
            'expansion_api_id' => 'required|string',
        ]);

        // Crear nueva carta
        Carta::create([
            'id_carta_api' => $request->input('id_carta_api'),
            // 'usuario_id' => auth()->id(), // Solo si tienes login
            'usuario_id' => auth()->id(), // ID del usuario autenticado
            'nombre_carta_api' => $request->input('nombre_carta_api'),
            'rareza' => $request->input('rareza'),
            'estado' => $request->input('estado'),
            'precio' => $request->input('precio'),
            'fecha_adquisicion' => $request->input('fecha_adquisicion'),
            'expansion_api_id' => $request->input('expansion_api_id'), 
        ]);

        return redirect()->route('cartas.mis')->with('success', 'Carta subida correctamente');

    }

    public function destroy($id)
    {
        $carta = Carta::findOrFail($id);
        $carta->delete();

        return redirect()->route('cartas.mis')->with('success', 'Carta eliminada correctamente');
    }
    


public function show($id_carta_api)
{
    // Obtener datos desde la API
    $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$id_carta_api}");

    if (!$apiResponse->successful() || !isset($apiResponse['data'])) {
        abort(404, 'Carta no encontrada');
    }

    $data = $apiResponse['data'];

    // Buscar vendedores en la BD
    $vendedores = \App\Models\Carta::where('id_carta_api', $id_carta_api)
        ->join('users', 'cartas.usuario_id', '=', 'users.id')
        ->select('cartas.id', 'cartas.estado', 'cartas.precio', 'users.name as vendedor')
        ->orderBy('cartas.precio', 'asc')
        ->get();

    return view('cartas.show', [
        'carta' => $data,                   // datos completos desde la API
        'vendedores' => $vendedores,
        'imagenCarta' => $data['images']['large'] ?? null
    ]);
}



public function porExpansion($codigo)
{
    $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards", [
        'q' => "set.id:$codigo",
        'pageSize' => 250
    ]);

    if (!$apiResponse->successful()) {
        abort(500, 'Error al obtener cartas de la expansión');
    }

    $cartas = $apiResponse['data'];

    return view('cartas.expansion', compact('cartas'));
}




}
