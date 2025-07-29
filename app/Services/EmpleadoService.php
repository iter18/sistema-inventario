<?php
namespace App\Services;

interface EmpleadoService
{
    /**
     * Crea un nuevo empleado.
     *
     * @param array $data
     * @return \App\Models\Empleado
     */
    public function crear(array $data,  $usuarioId,  $organizacionId, string $username);

    /**
     * Obtiene una lista de todos los empleados.
     *
     * @return array
     */
    public function listar($organizacionId,string $username,$perPage);

    /**
     * Actualiza un empleado existente.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Empleado
     */
    public function actualizar(int $id, array $data,string $username, $usuarioId);

    /**
     * Obtener un empleado por su ID.
     *
     * @param int $id
     * @return \App\Models\Empleado
     */
    public function obtenerPorId(int $id);

    /**
     * Elimina un empleado por su ID.
     */
}
