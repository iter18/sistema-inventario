<?php

namespace App\Services\impl;

use App\Models\Organizacion;
use App\Repositories\OrganizacionRepository;
use App\Services\OrganizacionService;


class OrganizacionServiceImpl implements OrganizacionService
{

    protected $organizacionRepository;

    /**
     * Constructor de la clase.
     */
    public function __construct(OrganizacionRepository $organizacionRepository)
    {
        // Aquí podrías inyectar dependencias si es necesario.
        $this->organizacionRepository = $organizacionRepository;
    }

    /**
     * Listar organizaciones.
     *
     * @return Collection
     */
    public function listar()
    {
        // Aquí iría la lógica para listar organizaciones.
        // Por ejemplo, podrías retornar un array de organizaciones.
        return $this->organizacionRepository->listar();
    }
}
