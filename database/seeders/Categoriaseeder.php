<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            ['nombre' => 'Base Set', 'descripcion' => 'Primer set clásico'],
            ['nombre' => 'Jungle', 'descripcion' => 'Set con cartas de bosque'],
            ['nombre' => 'Fossil', 'descripcion' => 'Cartas de fósiles'],
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }
    }
}
