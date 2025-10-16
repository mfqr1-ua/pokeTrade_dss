<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $casts = [
        'id_carta' => 'array',
    ];

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'id_carta',
        'created_at',
        'updated_at',
    ];

    public function cartas()
    {
        return Carta::whereIn('id_carta_api', $this->id_carta ?? [])->get();
    }
}
