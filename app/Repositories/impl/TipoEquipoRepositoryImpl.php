<?php

namespace App\Repositories\impl;

use App\Models\TipoEquipo;
use App\Repositories\TipoEquipoRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class TipoEquipoRepositoryImpl implements TipoEquipoRepository
{
    protected $model;

    public function __construct(TipoEquipo $model)
    {
        $this->model = $model;
    }


    public function listar()
    {
        return $this->model->all()->where('tpo_epo_baja', false)->sortBy('tpo_epo_descripcion')->values()->all();
    }

}
