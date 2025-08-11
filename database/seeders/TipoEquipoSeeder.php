<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoEquipo;

class TipoEquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoEquipo1 = TipoEquipo::firstOrCreate(['tpo_epo_descripcion' => 'Computo', 'tpo_epo_baja' => false]);
        $tipoEquipo2 = TipoEquipo::firstOrCreate(['tpo_epo_descripcion' => 'móvil', 'tpo_epo_baja' => false]);
        $tipoEquipo3 = TipoEquipo::firstOrCreate(['tpo_epo_descripcion' => 'Especializado', 'tpo_epo_baja' => false]);
        $tipoEquipo4 = TipoEquipo::firstOrCreate(['tpo_epo_descripcion' => 'Consumible', 'tpo_epo_baja' => false]);

    }
}
