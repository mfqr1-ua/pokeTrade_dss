<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carta;
use App\Models\User;

class CartaSeeder extends Seeder
{
    public function run()
    {
        $cartas = [
            [ "id_carta_api" => "swsh12pt5gg-GG70",   "name" => "Arceus VSTAR",              "expansion" => "swsh12pt5gg" ],
            [ "id_carta_api" => "swsh12pt5gg-GG69",   "name" => "Giratina VSTAR",            "expansion" => "swsh12pt5gg" ],
            [ "id_carta_api" => "swsh12pt5gg-GG68",   "name" => "Origin Forme Dialga VSTAR", "expansion" => "swsh12pt5gg" ],
            [ "id_carta_api" => "swsh12pt5gg-GG67",   "name" => "Origin Forme Palkia VSTAR", "expansion" => "swsh12pt5gg" ],
            [ "id_carta_api" => "swsh7-218",       "name" => "Rayquaza VMAX",             "expansion" => "swsh7" ],
            [ "id_carta_api" => "sv4-227",         "name" => "Toxtricity ex",             "expansion" => "sv4" ],
            [ "id_carta_api" => "sv5-104",         "name" => "Gengar ex",                 "expansion" => "sv5" ],
            [ "id_carta_api" => "swshp-SWSH291",   "name" => "Lucario VSTAR",             "expansion" => "swshp" ],
            [ "id_carta_api" => "sv9-182",         "name" => "Volcanion ex",              "expansion" => "sv9" ],
            [ "id_carta_api" => "sv9-1",           "name" => "Caterpie",                  "expansion" => "sv9" ]
        ];

        $users = User::all();
        $index = 0;

        foreach ($users as $user) {
            if (!isset($cartas[$index])) break;

            $carta = $cartas[$index++];

            Carta::create([
                'id_carta_api'      => $carta['id_carta_api'],
                'expansion_api_id'  => $carta['expansion'],
                'nombre_carta_api'  => $carta['name'],
                'usuario_id'        => $user->id,
                'rareza'            => ['Común', 'Rara', 'Holo Rare', 'Promo'][rand(0, 3)],
                'estado'            => ['Nuevo', 'Bueno', 'Regular', 'Usado', 'Dañado', 'Mint'][rand(0, 5)],
                'precio'            => round(rand(100, 30000) / 100, 2),
                'fecha_adquisicion' => now()->subDays(rand(0, 365)),
            ]);
        }
    }
}
