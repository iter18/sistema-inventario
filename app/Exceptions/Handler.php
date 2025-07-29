<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
//use App\Exceptions\PermisoDenegadoException;
use App\Exceptions\RecursoNoEncontradoException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        RecursoNoEncontradoException::class
        //PermisoDenegadoException::class,
    ];

    /**
     * Render una excepción no autenticada (sin JWT por ejemplo).
     */
    /*protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'message' => 'No autenticadoaaa.',
        ], 401);
    }*/


     public function render($request, Throwable $exception)
    {
       Log::error('Excepción capturada en Handler: ' . get_class($exception) . ' - ' . $exception->getMessage());

        // Manejar RecursoNoEncontradoException
        if ($exception instanceof RecursoNoEncontradoException) {
            Log::info('Capturada RecursoNoEncontradoException: ' . $exception->getMessage());
            return response()->json([
                'error' => 'Recurso no encontrado',
                'mensaje' => $exception->getMessage()
            ], 404);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'error' => 'No autenticado',
                'mensaje' => 'Credenciales inválidas o token expirado'
            ], 401);
        }


        return parent::render($request, $exception);
    }
}
