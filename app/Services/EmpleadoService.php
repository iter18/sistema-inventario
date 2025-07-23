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
}
