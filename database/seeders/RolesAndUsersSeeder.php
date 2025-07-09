<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles si no existen
        $adminRole = Role::firstOrCreate(['rol_nombre' => 'admin']);
        $userRole = Role::firstOrCreate(['rol_nombre' => 'user']);

        // Crear un usuario de prueba con contraseña encriptada
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'), // ✅ Contraseña encriptada
            ]
        );

        // Asignar rol al usuario
        $adminUser->roles()->sync([$adminRole->id]); // Usa sync para evitar duplicados

    }
}
