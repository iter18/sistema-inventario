<?php

namespace Database\Seeders;

use App\Models\Organizacion;
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
        $organizationUser1 = Organizacion::firstOrCreate(['org_nombre' => 'Kuka Systems Mexico 1']);
        $organizationUser2 = Organizacion::firstOrCreate(['org_nombre' => 'Kuka Systems Mexico 2']);

        // Crear un usuario de prueba con contraseña encriptada
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'), // ✅ Contraseña encriptada
            ]
        );

        // Asignar rol al usuario
        $adminUser->roles()->sync([$adminRole->role_id]);
        $adminUser->organizaciones()->sync([$organizationUser1->org_id, $organizationUser2->org_id]);

        // Usa sync para evitar duplicados

    }
}
