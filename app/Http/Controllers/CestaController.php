<?php
namespace App\Http\Controllers;

use App\Models\Cesta;
use App\Models\CestaItem;
use App\Models\Carta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CestaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Carga la cesta más reciente del usuario (la vacía tras pedido)
        $cesta = Cesta::with('items.carta')
            ->where('user_id', $user->id)
            ->orderByDesc('id') // Importante: trae la última cesta creada
            ->first();

        // Si no hay ninguna (raro, pero posible), se crea una nueva
        if (!$cesta) {
            $cesta = Cesta::create(['user_id' => $user->id]);
        }

        $cartasEnCesta = $cesta->items;
        $precioTotal = $cartasEnCesta->sum(fn($item) => $item->cantidad * $item->precio_unitario);

        return view('cesta.cesta', compact('cartasEnCesta', 'precioTotal'));
    }

    
    public function agregar(Request $request)
    {
        $request->validate([
            'carta_id' => 'required|exists:cartas,id'
        ], [
            'carta_id.exists' => '¡La carta no existe en la base de datos!',
        ]);

        $user = Auth::user();
        $cesta = Cesta::where('user_id', $user->id)->orderByDesc('id')->first();

        if (!$cesta) {
            $cesta = Cesta::create(['user_id' => $user->id]);
        }


        $item = CestaItem::where('cesta_id', $cesta->id)
                    ->where('carta_id', $request->carta_id)
                    ->first();

        if ($item) {
            $item->cantidad += 1;
            $item->save();
        } else {
            CestaItem::create([
                'cesta_id' => $cesta->id,
                'carta_id' => $request->carta_id,
                'cantidad' => 1,
                'precio_unitario' => Carta::find($request->carta_id)->precio,
            ]);
        }

        return redirect()->route('cesta.index')->with('success', 'Carta añadida a la cesta.');
    }


    public function eliminar($id)
    {
        CestaItem::destroy($id);
        return redirect()->route('cesta.index')->with('success', 'Carta eliminada');
    }

    public function comprar()
    {
        $user = Auth::user();
        $cesta = Cesta::where('user_id', $user->id)->first();

        if ($cesta) {
            $items = $cesta->items;

            // Eliminar las cartas de la base de datos (para que no se puedan volver a comprar)
            foreach ($items as $item) {
                $item->carta->delete();
            }

            // Luego eliminar los ítems de la cesta
            $cesta->items()->delete();
        }

        return redirect()->route('inicio')->with('success', 'Compra realizada correctamente');
    }
    public function incrementar($id)
    {
        $item = CestaItem::findOrFail($id);
        $item->cantidad += 1;
        $item->save();

        return redirect()->route('cesta.index');
    }

    public function decrementar($id)
    {
        $item = CestaItem::findOrFail($id);
        $item->cantidad = max(1, $item->cantidad - 1); // No baja de 1
        $item->save();

        return redirect()->route('cesta.index');
    }
    public function vaciar()
    {
        $user = Auth::user();
        $cesta = Cesta::where('user_id', $user->id)->first();

        if ($cesta) {
            $cesta->items()->delete(); // elimina todos los CestaItem
            $cesta->delete(); // elimina la propia cesta
        }

        return redirect()->route('cesta.index')->with('success', 'Cesta vaciada correctamente');
    }

    public function procesarPago(Request $request)
    {
        $user = Auth::user();
        $cesta = Cesta::with('items.carta')->where('user_id', $user->id)->first();

        if (!$cesta || $cesta->items->isEmpty()) {
            return redirect()->route('cesta.index')->with('error', 'Cesta vacía');
        }

        // Crear contenido del PDF o texto
        $contenido = "Gracias por tu compra en PokeMarket TCG\n\n";
        foreach ($cesta->items as $item) {
            $contenido .= "- " . $item->carta->nombre_carta_api . " x{$item->cantidad} = " . number_format($item->cantidad * $item->precio_unitario, 2) . " €\n";
        }

        $total = $cesta->items->sum(fn($i) => $i->cantidad * $i->precio_unitario);
        $contenido .= "\nTotal con IVA: " . number_format($total * 1.21, 2) . " €\n";

        // Guardar fichero
        $nombreFichero = 'resumen_compra_' . time() . '.txt';
        Storage::disk('local')->put($nombreFichero, $contenido);

        // Enviar correo
        Mail::raw("Adjunto el resumen de tu compra.", function($mensaje) use ($user, $nombreFichero) {
            $mensaje->to($user->email)
                ->subject('Resumen de tu compra en PokeMarket TCG')
                ->attach(storage_path('app/' . $nombreFichero));
        });

        // Limpiar cesta
        $cesta->items()->delete();
        $cesta->delete();
        Cesta::create(['user_id' => $user->id]); // nueva cesta vacía
        return redirect()->route('cesta.index')->with('success', 'Pago realizado con éxito. Revisa tu correo.');
    }
}