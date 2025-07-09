<?php

namespace App\Services\impl;

use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
// Import the Auth facade to handle authentication


class AuthServiceImpl implements AuthService
{

    public function login(array $credentials)
    {

        // Validate the credentials
        if (empty($credentials['usuario']) || empty($credentials['password'])) {
            Log::error('Credenciales incompletas para el usuario');
            return response()->json(['error' => 'Credenciales incompletas'], 400);
        }

        Log::info('Usuario :username generando token..... ', ['username' =>  $credentials['usuario']]);

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        /** @var \Tymon\JWTAuth\JWTGuard $guard */
        $guard = Auth::guard('api');

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   =>$guard->factory()->getTTL() * 60
        ]);
    }
}
