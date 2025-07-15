<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizacionResource;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use App\Services\OrganizacionService;

class OrganizacionController extends Controller
{

    protected $organizacionService;

    /**
     * Constructor de la clase.
     */
    public function __construct(OrganizacionService $organizacionService)
    {
        $this->organizacionService = $organizacionService;
    }


    /**
     * Muestra una lista de las organizaciones.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar()
    {
        $organizaciones = $this->organizacionService->listar();

        if ($organizaciones->isEmpty()) {
            return response()->json(['message' => 'No se encontraron organizaciones'], 404);
        }

        return OrganizacionResource::collection($organizaciones);
    }
}
