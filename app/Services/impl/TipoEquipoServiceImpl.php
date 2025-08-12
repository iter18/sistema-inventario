<?php

namespace App\Services\impl;

use App\Repositories\TipoEquipoRepository;
use App\Services\TipoEquipoService;
use Illuminate\Support\Facades\Log;

class TipoEquipoServiceImpl implements TipoEquipoService
{

    protected $tipoEquipoRepository;

    public function __construct(TipoEquipoRepository $tipoEquipoRepository)
    {
        $this->tipoEquipoRepository = $tipoEquipoRepository;
    }


    public function listar()
    {

            Log::info("Listando tipos de equipo.....");
            return $this->tipoEquipoRepository->listar();

    }

}
