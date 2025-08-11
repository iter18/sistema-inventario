<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marca1 = \App\Models\Marca::firstOrCreate(['mar_descripcion' => 'DELL', 'mar_baja' => false]);
        $marca2 = \App\Models\Marca::firstOrCreate(['mar_descripcion' => 'HP', 'mar_baja' => false]);
        $marca3 = \App\Models\Marca::firstOrCreate(['mar_descripcion' => 'LENOVO', 'mar_baja' => false]);
        $marca4 = \App\Models\Marca::firstOrCreate(['mar_descripcion' => 'APPLE', 'mar_baja' => false]);
        $marca5 = \App\Models\Marca::firstOrCreate(['mar_descripcion' => 'SAMSUNG', 'mar_baja' => false]);

        // You can add more marcas as needed
        // $marca6 = \App\Models\Marca::firstOrCreate(['mar_descripcion' => 'NEW BRAND', 'mar_baja' => false]);

        // Example of how to add more marcas
        // $marca7 = \App\Models\Marca::firstOrCreate(['mar_descripcion' => 'ANOTHER BRAND', 'mar_baja' => false]);

        // Additional marcas can be added here as needed
    }
}
