<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Modulo;

class CheckUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $route): Response
    {
        $user = Auth::user();

        $user_perfil = $user->perfil;

        // $hasAccess = $user_perfil->perfilmodulo->modulo->where('Modelo_ruta', $route)->exists();

        $hasAccess = Modulo::where('ruta', $route)
        ->whereHas('perfiles', function ($query) use ($user_perfil) {
            $query->where('Perfil_descripcion', $user_perfil->Perfil_descripcion);
        })
        ->exists();

        if(!$hasAccess){
            return response('No autorizado',403);
        }

        return $next($request);
    }
}
