<?php

namespace App\Http\Controllers;
use App\Models\Expansion;
use App\Models\Carta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExpansionController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.pokemontcg.io/v2/sets');
        $expansiones = $response->json()['data'] ?? [];

        // Excluir las que contengan "Trainer Gallery"
        $expansiones = array_filter($expansiones, function ($expansion) {
            return stripos($expansion['name'], 'Trainer Gallery') === false;
        });

        // Ordenar por fecha de lanzamiento descendente
        usort($expansiones, function ($a, $b) {
            return strtotime($b['releaseDate'] ?? '1970-01-01') <=> strtotime($a['releaseDate'] ?? '1970-01-01');
        });

        // Tomar solo las últimas 40
        $expansiones = array_slice($expansiones, 0, 40);

        return view('expansiones.index', compact('expansiones'));
    }

    public function verCartas($id)
    {
        $cartas = Carta::where('expansion_api_id', $id)->get();

        return view('expansiones.cartas', [
            'expansion_name' => $id,
            'cartas' => $cartas
        ]);
    }
}

