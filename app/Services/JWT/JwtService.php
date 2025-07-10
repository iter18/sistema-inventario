<?php
namespace App\Services\JWT;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtService
{
    /**
     * Genera un token JWT para un usuario, agregando claims personalizados dinámicos
     *
     * @param User $user
     * @param array $customClaims
     * @return string Token JWT
     */
    public function createToken(User $user, array $customClaims = []): string
    {
        // Genera token sin claims extras
        $token = JWTAuth::fromUser($user);

        // Decodifica payload para agregar claims personalizados manualmente
        $payload = JWTAuth::setToken($token)->getPayload()->toArray();

        // Mezcla los claims existentes con los personalizados
        $newPayload = array_merge($payload, $customClaims);

        // Crea un nuevo token con los claims extendidos
        // IMPORTANTE: Tymon/jwt-auth no tiene un método directo para modificar claims ya creados,
        // así que se recomienda generar el token pasando los claims en fromUser() con merge

        // Por eso la forma correcta es generar el token con los claims personalizados:
        return JWTAuth::claims($customClaims)->fromUser($user);
    }
}
