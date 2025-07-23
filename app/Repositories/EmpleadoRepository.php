<?php

namespace App\Repositories;

use App\Models\Empleado;

interface EmpleadoRepository
{
    public function crear(array $data): Empleado;
}
