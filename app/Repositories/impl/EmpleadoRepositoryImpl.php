<?php

namespace App\Repositories\impl;

use App\Models\Empleado;
use App\Repositories\EmpleadoRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;


class EmpleadoRepositoryImpl implements EmpleadoRepository
{

        protected $model;

    public function __construct(Empleado $model)
    {
        $this->model = $model;
    }


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

    public function listar($organizacionId,$resPorPagina)
    {
        return $this->model->with('departamento')
        ->where('emp_org_id', $organizacionId)
        ->where('emp_baja', false)
        ->orderBy('emp_id', 'desc')
        ->paginate($resPorPagina);
    }
}
