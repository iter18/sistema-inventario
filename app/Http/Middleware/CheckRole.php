<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Primero, nos aseguramos de que el usuario esté autenticado.
        //    Si no lo está, no tiene sentido verificar roles.
        if (! $request->user()) {
            // Devolvemos un error 401 (No autenticado), que es más preciso.
            return response()->json(['message' => 'No autenticado.'], 401);
        }

        // 2. Iteramos sobre cada uno de los roles que se pasaron al middleware.
        //    Por ejemplo, en `middleware('role:admin,editor')`, $roles será un array ['admin', 'editor'].
        foreach ($roles as $role) {
            // 3. Usamos el método `hasRole()` que ya tienes en tu modelo User para verificar
            //    si el usuario autenticado tiene el rol actual de la iteración.
            if ($request->user()->hasRole($role)) {
                // 4. Si el usuario tiene al menos UNO de los roles requeridos,
                //    le damos acceso y dejamos que la petición continúe hacia el controlador.
                return $next($request);
            }
        }

        // 5. Si el bucle termina y el usuario no tenía ninguno de los roles,
        //    significa que no tiene permiso. Le negamos el acceso con un error 403 (Prohibido).
        return response()->json(['message' => 'Acceso no autorizado. No tienes el rol requerido.'], 403);
    }
}
