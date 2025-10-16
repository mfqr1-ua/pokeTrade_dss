<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function realizar(Request $request)
    {
        $user = Auth::user();

        // Obtener la cesta actual del usuario con los productos
        $cesta = Cesta::with('items.carta')
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->first();

        if (!$cesta || $cesta->items->isEmpty()) {
            return redirect()->route('cesta.index')->with('error', 'La cesta está vacía.');
        }

        try {
            foreach ($cesta->items as $item) {
                $carta = $item->carta;

                if (!$carta) continue;

                Pedido::create([
                    'cliente_id'        => $user->id,
                    'cesta_id'          => $cesta->id,
                    'direccion_envio'   => $user->direccion ?? 'no_aplica',
                    'nombre_cliente'    => $user->name ?? 'Desconocido',
                    'metodo_pago'       => $request->input('metodo_pago', 'Tarjeta'),
                    'fecha_pedido'      => now(),
                    'comprador_id'      => $carta->usuario_id ?? null,
                    'id_carta_api'      => $carta->id_carta_api ?? null,

                    // Datos de la carta copiados antes de borrarla
                    'nombre_carta_api'  => $carta->nombre_carta_api ?? 'desconocido',
                    'rareza'            => $carta->rareza ?? 'Desconocida',
                    'precio'            => $carta->precio ?? 0,
                    'estado_carta'      => $carta->estado ?? 'No especificado',
                    'expansion_api_id'  => $carta->expansion_api_id ?? null,
                ]);

                // Eliminar la carta de la base de datos
                $carta->delete();
            }

            // Vaciar ítems y crear nueva cesta
            $cesta->items()->delete();
            Cesta::create(['user_id' => $user->id]);

        } catch (\Exception $e) {
            dd('Error al crear el pedido: ' . $e->getMessage());
        }

        return redirect()->route('cesta.index')->with('success', 'Pedido registrado correctamente.');
    }

    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function index()
    {
        $usuarioId = Auth::id();
        $pedidos = Pedido::where('cliente_id', $usuarioId)->get();

        return view('pedidos.index', compact('pedidos'));
    }
}
