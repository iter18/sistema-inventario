<?php

namespace App\Repositories\impl;

use App\Models\Empleado;
use App\Repositories\EmpleadoRepository;
use Illuminate\Support\Facades\Log;

class EmpleadoRepositoryImpl implements EmpleadoRepository
{
    public function crear(array $data): Empleado
    {
        try {
            $empleado = Empleado::create($data);
            return $empleado;
        } catch (\Exception $e) {
            Log::error('Error al crear empleado en el repositorio: ' . $e->getMessage());
            throw new \Exception('Error al crear empleado: ' . $e->getMessage());
        }
    }
}
