<?php

namespace App\Http\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render una excepción no autenticada (sin JWT por ejemplo).
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'message' => 'No autenticado.',
        ], 401);
    }

    /**
     * Renderiza cualquier otra excepción.
     */
    public function render($request, Throwable $e)
    {
        return parent::render($request, $e);
    }
}
