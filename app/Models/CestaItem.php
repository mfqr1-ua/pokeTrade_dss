<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CestaItem extends Model
{
    protected $fillable = ['cesta_id', 'carta_id', 'cantidad', 'precio_unitario'];

    public function cesta()
    {
        return $this->belongsTo(Cesta::class);
    }

    public function carta()
    {
        return $this->belongsTo(Carta::class);
    }
}
