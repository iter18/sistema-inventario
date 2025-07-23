<?php

namespace App\Http\Controllers;

use App\Services\EmpleadoService;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\EmpleadoResource;
use App\Http\Requests\StoreEmpleadoRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;


class EmpleadoController extends Controller
{
    protected $empleadoService;

    public function __construct(EmpleadoService $empleadoService)
    {
        $this->empleadoService = $empleadoService;
    }

    public function crear(StoreEmpleadoRequest $request)
    {
        try {

            $data = $request->toDatabase();
            // Obtener el ID del usuario autenticado
            $usuarioId = $request->user()->id;
            $username = $request->user()->name;

            // Obtener el ID de la organización desde los claims del JWT
             /** @var \Tymon\JWTAuth\JWT $jwt */
            $jwt = auth();
            $payload = $jwt->payload();
            $organizacionId = $payload->get('id_organizacion');

            $empleado = $this->empleadoService->crear($data, $usuarioId, $organizacionId, $username);

            return response()->json([
                'message' => 'Empleado creado exitosamente',
                'empleado' => new EmpleadoResource($empleado)
            ], 201);
        } catch (HttpException $e) {
            return response()->
                json(['error' => $e->getMessage()], $e->getStatusCode());
        } catch (\Exception $e) {
            Log::error('Error al crear empleado: ' . $e->getMessage());
            return response()->json(['error' => 'Error al crear empleado'], 500);
        }
    }
}

