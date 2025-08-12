<?php

namespace App\Services\impl;

use App\Repositories\MarcaRepository;
use App\Services\MarcaService;
use Illuminate\Support\Facades\Log;

class MarcaServiceImpl implements MarcaService
{

    protected $marcaRepository;

    public function __construct(MarcaRepository $marcaRepository)
    {
        $this->marcaRepository = $marcaRepository;
    }


    public function listar()
    {

            Log::info("Listando marcas.....");
            return $this->marcaRepository->listar();

    }

}
