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
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'message' => 'No autenticado.',
        ], 401);
    }


    public function render($request, Throwable $exception): JsonResponse
    {
         Log::error('Excepción capturada en Handler: ' . get_class($exception) . ' - ' . $exception->getMessage());
        if ($$exception instanceof \App\Exceptions\RecursoNoEncontradoException || is_subclass_of($exception, \App\Exceptions\RecursoNoEncontradoException::class)) {
             Log::error('RecursoNoEncontradoException.................: ' . $exception->getMessage());
            return response()->json([
                'error' => 'Recurso no encontrado',
                'mensaje' => $exception->getMessage()
            ], 404);
        }

        return parent::render($request, $exception);
    }
}
