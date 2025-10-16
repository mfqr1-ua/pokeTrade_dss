<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Test',
                'password' => Hash::make('password'),
                'admin' => 1,
            ]
        );

        User::factory(5)->create(); // Resto de usuarios aleatorios
    }
}
