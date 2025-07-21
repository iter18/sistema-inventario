<?php

namespace App\Repositories\impl;

use App\Models\Departamento;
use App\Repositories\DepartamentoRepository;
use Illuminate\Database\Eloquent\Collection;


class DepartamentoRepositoryImpl implements DepartamentoRepository
{

    protected $model;

    public function __construct(Departamento $model)
    {
        $this->model = $model;
    }


    /**
     * List all organizations.
     *
     * @return array
     */
    public function listar():Collection
    {

        $departamentos = $this->model->all();
        return $departamentos;
    }

    public function obtenerPorOrganizacion($organizacionId): Collection
    {
        return $this->model->where('dep_org_id', $organizacionId)
        ->where('dep_baja', false)
        ->get();
    }
}
