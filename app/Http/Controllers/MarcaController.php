<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarcaResource;
use App\Services\MarcaService;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    protected $marcaService;

    public function __construct(MarcaService $marcaService)
    {
        $this->marcaService = $marcaService;
    }

    public function listar()
    {
        return MarcaResource::collection($this->marcaService->listar());
    }
}
