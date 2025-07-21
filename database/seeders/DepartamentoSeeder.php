<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departamento1 = Departamento::firstOrCreate(['dep_nombre' => 'Departamento de Ventas', 'dep_clave' => '0001', 'dep_org_id' => 1, 'dep_baja' => false]);
        $departamento2 = Departamento::firstOrCreate(['dep_nombre' => 'Departamento de Recursos Humanos', 'dep_clave' => '0002', 'dep_org_id' => 1, 'dep_baja' => false]);
        $departamento3 = Departamento::firstOrCreate(['dep_nombre' => 'Departamento de IT', 'dep_clave' => '0003', 'dep_org_id' => 2, 'dep_baja' => false]);
        $departamento4 = Departamento::firstOrCreate(['dep_nombre' => 'Departamento de Finanzas', 'dep_clave' => '0004', 'dep_org_id' => 2, 'dep_baja' => false]);
    }
}
