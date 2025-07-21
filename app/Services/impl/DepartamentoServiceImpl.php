<?php

namespace App\Services\impl;

use App\Repositories\DepartamentoRepository;
use App\Services\DepartamentoService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DepartamentoServiceImpl implements DepartamentoService
{

    protected $departamentoRepository;

    /**
     * Constructor de la clase.
     */
    public function __construct(DepartamentoRepository $departamentoRepository)
    {
        $this->departamentoRepository = $departamentoRepository;
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
        return $this->departamentoRepository->listar();
    }

    public function obtenerPorOrganizacion($organizacionId)
    {
        $departamentos = $this->departamentoRepository->obtenerPorOrganizacion($organizacionId);

         if ($departamentos->isEmpty()) {
            // Aquí lanzas una excepción del framework, será convertida a JSON automáticamente
            throw new NotFoundHttpException("No se encontraron departamentos para la organización $organizacionId.");
        }

        return $departamentos;
        // Implementación pendiente
    }
}
