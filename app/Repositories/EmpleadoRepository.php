<?php

namespace App\Repositories;

use App\Models\Empleado;

interface EmpleadoRepository
{
    public function crear(array $data): Empleado;

    public function listar(int $organizacionId,int $resPorPagina);

    /**
     * Actualiza un empleado existente.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Empleado
     */
    public function actualizar(Empleado $empleado): Empleado;

    /**
     * Obtener un empleado por su ID.
     *
     * @param int $id
     * @return \App\Models\Empleado
     */
    public function obtenerPorId(int $id): ?Empleado;

}
