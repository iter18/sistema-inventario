<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $authorization = $request->header('Authorization');
        if (!$authorization || !str_starts_with($authorization, 'Basic ')) {
            return response()->json(['error' => 'No se encontró el header Authorization'], 400);
        }

        $base64Credentials = substr($authorization, 6);
        $decoded = base64_decode($base64Credentials);
        [$usuario, $password] = explode(':', $decoded, 2);

        // También extrae la organización del header
        $orgId = $request->header('X-organizacionId');

        $credentials = [
            'usuario' => $usuario,
            'password' => $password,
            'organizacion_id' => $orgId,
        ];
        return $this->authService->login($credentials);
    }
}
