<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Administrador / Auditor
        User::create([
            'name' => 'Administrador',
            'email' => 'jerorrpo@gmail.com',
            'password' => Hash::make('jero0312'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        // Gestor de Inventario (Editor)
        User::create([
            'name' => 'Gestor Inventario',
            'email' => 'gestor@sistema.com',
            'password' => Hash::make('jero0312'),
            'role' => 'editor',
            'is_active' => true,
        ]);

        // Usuario Consulta (Viewer)
        User::create([
            'name' => 'Usuario Demo',
            'email' => 'jerorrpo11@gmail.com',
            'password' => Hash::make('jero0312'),
            'role' => 'viewer',
            'is_active' => true,
        ]);
    }
}
