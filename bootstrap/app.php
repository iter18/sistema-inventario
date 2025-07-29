<?php

use App\Exceptions\Handler;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        api: __DIR__ . '/../routes/api.php'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('api/*')) {
                return null;
            }

            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /*
        $exceptions->render(function (AuthenticationException $e, $request) {
            return response()->json([
                'message' => 'No autenticadoqq.',
            ], 401);
        });*/
               $exceptions->render(function (\Throwable $e, $request) {
            $handler = app(\App\Exceptions\Handler::class);
            return $handler->render($request, $e);
        });
    })->create();
