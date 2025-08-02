<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmpleadoService;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\EmpleadoResource;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Exceptions\RecursoNoEncontradoException;
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

    public function listar(Request $request)
    {


        $username = $request->user()->name;
        // Obtener el ID de la organización desde los claims del JWT
            /** @var \Tymon\JWTAuth\JWT $jwt */
        $jwt = auth();
        $payload = $jwt->payload();
        $organizacionId = $payload->get('id_organizacion');
        //Obtener el numero de elementos por pagina, si no se especifica mostrara el valor por defecto
        $perPage = $request->query('per_page',2);

        $empleados = $this->empleadoService->listar($organizacionId,$username,$perPage);

        //return EmpleadoResource::collection($empleados);
        return $empleados;
    }

    public function actualizar(int $id, StoreEmpleadoRequest $request)
    {
        try {
            $data = $request->toDatabase();
            $username = $request->user()->name;
            $usuarioId = $request->user()->id;
            $empleado = $this->empleadoService->actualizar($id, $data, $username, $usuarioId);

            return response()->json([
                'message' => 'Empleado actualizado exitosamente',
                'empleado' => new EmpleadoResource($empleado)
            ]);
        } catch (RecursoNoEncontradoException $e) {
            // Esta excepción será manejada por el Handler
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error al actualizar empleado: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar empleado'], 500);
        }
    }

    public function eliminar(Request $request, int $id)
    {
        try {
            $username = $request->user()->name;
            $this->empleadoService->eliminar($id, $username);

            // Retorna 204 No Content, que es el estándar para un DELETE exitoso.
            return response()->noContent();
        } catch (RecursoNoEncontradoException $e) {
            // El Exception Handler global convertirá esto en una respuesta 404.
            throw $e;
        } catch (\Exception $e) {
            Log::error("Error al eliminar empleado con ID {$id}: " . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error interno al intentar eliminar el empleado.'], 500);
        }
    }
}
