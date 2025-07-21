<?php

namespace App\Http\Controllers;

use App\Services\DepartamentoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartamentoController extends Controller
{
    // This controller is currently empty, but can be used for future Departamento-related logic.
    // You can add methods here to handle requests related to the Departamento model.

    protected $departamentoService;

    public function __construct(DepartamentoService $departamentoService)
    {
        $this->departamentoService = $departamentoService;
    }

    public function listarPorOrganizacion(Request $request)
    {

        // 1. Obtener el ID del usuario autenticado
        //$usuarioId = $request->user()->id; // o auth()->id()

        // 2. Obtener el ID de la organización desde los claims del JWT
        /** @var \Tymon\JWTAuth\JWT $jwt */
        $jwt = auth();
        $payload = $jwt->payload();
        $organizacionId = $payload->get('id_organizacion');
        $departamentos = $this->departamentoService->obtenerPorOrganizacion($organizacionId);


        return response()->json([
            'message' => 'Lista de departamentos obtenida correctamente',
            'data' => $departamentos
        ], 200);

    }

}
