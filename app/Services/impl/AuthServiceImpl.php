<?php

namespace App\Services\impl;

use App\Models\User;
use App\Services\JWT\JwtService;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// Import the Auth facade to handle authentication


class AuthServiceImpl implements AuthService
{

    protected $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function login(array $credentials)
    {
        $email = $credentials['usuario'] ?? null;
        $password = $credentials['password'] ?? null;
        $orgId = $credentials['organizacion_id'] ?? null;

        // Validate the credentials
        if (empty($email) || empty($password) || empty($orgId)) {
            Log::error('Credenciales incompletas para el usuario');
            return response()->json(['error' => 'Credenciales incompletas'], 400);
        }

        Log::info('Usuario :username generando token..... ', ['username' =>  $email]);

        // Busca el usuario
        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        // Valida que el usuario pertenezca a la organización
        $user->load('organizaciones', 'roles');

        if ($user->organizaciones->isEmpty()) {
            return response()->json(['error' => 'Usuario no pertenece a ninguna organización'], 401);
        }

        if (!$user->organizaciones->contains('org_id', $orgId)) {
            return response()->json(['error' => 'Usuario no pertenece a la organización'], 401);
        }

        // Claims personalizados dinámicos
        $customClaims = [
            'id_organizacion' => $orgId,
            'roles' => $user->roles->pluck('rol_nombre')
        ];

        $token = $this->jwtService->createToken($user, $customClaims);

        // Si el token es nulo, significa que hubo un error al generarlo
        if (!$token) {
            Log::error('Error al generar el token JWT para el usuario: ' . $email);
            return response()->json(['error' => 'Error al generar el token'], 500);
        }
        Log::info('Token JWT generado exitosamente para el usuario: ' . $email);

        /** @var \Tymon\JWTAuth\JWTGuard $guard */
        $guard = Auth::guard('api');

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => $guard->factory()->getTTL() * 60
        ]);
    }
}
