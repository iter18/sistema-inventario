<?php

namespace App\Repositories\impl;

use App\Models\Organizacion;
use App\Repositories\OrganizacionRepository;
use Illuminate\Database\Eloquent\Collection;

class OrganizacionRepositoryImpl implements OrganizacionRepository
{

    protected $model;

    public function __construct(Organizacion $model)
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

        $organizaciones = $this->model->all();
        return $organizaciones;
    }
}
