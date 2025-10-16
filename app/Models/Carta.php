<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    use HasFactory;

    protected $table = 'cartas';

    protected $fillable = [
        'id_carta_api',
        'nombre_carta_api',
        'usuario_id',
        'rareza',
        'estado',
        'precio',
        'fecha_adquisicion',
        'expansion_api_id',
    ];

    public function ventas()
    {
        return $this->hasMany(\App\Models\Venta::class);
    }
    public function usuario()
{
    return $this->belongsTo(User::class, 'usuario_id');
}

}
