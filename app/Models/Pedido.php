<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'cesta_id',
        'direccion_envio',
        'nombre_cliente',
        'metodo_pago',
        'fecha_pedido',
        'comprador_id',
        'id_carta_api',
        'nombre_carta_api',
        'rareza',
        'precio',
        'estado_carta',
        'expansion_api_id',
    ];
    public function items()
{
    return $this->hasManyThrough(
        \App\Models\CestaItem::class,
        \App\Models\Cesta::class,
        'id', // Foreign key on `pedidos` (cesta_id)
        'cesta_id', // Foreign key on `cesta_items`
        'cesta_id', // Local key on `pedidos`
        'id' // Local key on `cestas`
    )->with('carta.usuario');
}
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function comprador()
    {
        return $this->belongsTo(User::class, 'comprador_id');
    }

    public function cesta()
    {
        return $this->belongsTo(Cesta::class);
    }
}
