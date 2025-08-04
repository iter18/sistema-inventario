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

    public function listar(int $organizacionId, int $resPorPagina, ?string $nombreEmpleado, ?int $idDepartamento)
    {
        return $this->model->with('departamento')
        ->where('emp_org_id', $organizacionId)
        ->where('emp_baja', false)
        ->when($nombreEmpleado, function ($query, $nombreEmpleado) {
            return $query->where('emp_nombre', 'like', '%' . $nombreEmpleado . '%');
        })
        ->when($idDepartamento, function ($query, $idDepartamento) {
            return $query->where('emp_dep_id', $idDepartamento);
        })
        ->orderBy('emp_id', 'desc')
        ->paginate($resPorPagina);
    }

    /**
     * Actualiza un empleado existente.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Empleado
     */
    public function actualizar(Empleado $empleado): Empleado
    {
        try {
            $empleado->save();
            return $empleado;
        } catch (\Exception $e) {
            Log::error('Error al actualizar empleado '. $e->getMessage());
            throw new \Exception('Error al actualizar empleado: ' . $e->getMessage());
        }
    }

    /**
     * Obtner un empleado por su ID.
     *
     * @param int $id
     * @return \App\Models\Empleado
     */
    public function obtenerPorId(int $id):?Empleado
    {
        return $this->model->find($id);
    }

    /**
     * Elimina un empleado por su ID.
     */
    public function eliminar(Empleado $empleado): bool
    {
        try {
            $empleado->emp_baja = true;
            $empleado->emp_fecha_baja = now();
             Log::info("Empleado dado de baja...");
            return $empleado->save();
        } catch (\Exception $e) {
            Log::error('Error al eliminar empleado en el repositorio: ' . $e->getMessage());
            // Re-lanzamos para que la capa de servicio pueda manejarlo.
            throw new \Exception('Error al eliminar empleado: ' . $e->getMessage());
        }
    }
}
