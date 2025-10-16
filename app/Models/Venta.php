<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'carta_id',
        'estado',
        'precio',
        'fecha_adquisicion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carta()
    {
        return $this->belongsTo(Carta::class);
    }
}
