<?php

namespace App\Http\Controllers;


use App\Http\Resources\TipoEquipoResource;
use App\Services\TipoEquipoService;

class TipoEquipoController extends Controller
{
    protected $tipoEquipoService;

    public function __construct(TipoEquipoService $tipoEquipoService)
    {
        $this->tipoEquipoService = $tipoEquipoService;
    }


    public function listar()
    {
        return TipoEquipoResource::collection($this->tipoEquipoService->listar());
    }
}

