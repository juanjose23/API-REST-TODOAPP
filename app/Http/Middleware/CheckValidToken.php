<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class CheckValidToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Intentar obtener el token desde los encabezados Authorization
            $token = $request->bearerToken();

            // Si no hay token, devolver un error 401
            if (!$token) {
                return response()->json(['message' => 'Token no proporcionado'], 401);
            }

            // Intentar verificar el token usando JWTAuth
            $user = JWTAuth::parseToken()->authenticate();

            // Si el token es válido, continuar con la solicitud
            $request->merge(['user' => $user]);  // Puedes agregar el usuario a la solicitud si lo necesitas

            return $next($request);

        } catch (JWTException $e) {
            // Si el token no es válido o ha expirado, devolver un error 401
            return response()->json(['message' => 'Token inválido o expirado'], 401);
        }
    }
}
