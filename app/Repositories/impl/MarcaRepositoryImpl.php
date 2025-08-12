<?php

namespace App\Repositories\impl;

use App\Models\Marca;
use App\Repositories\MarcaRepository;
use Illuminate\Support\Facades\Log;

class MarcaRepositoryImpl implements MarcaRepository
{

    protected $model;

    public function __construct(Marca $model)
    {
        $this->model = $model;
    }


    public function listar()
    {
        return $this->model->all()->sortBy('mar_descripcion')->where('mar_baja', false)->values()->all();
    }
}
