<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Modulo;
use App\Models\PerfilModulo;

class CheckUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,): Response
    {
        $user = Auth::user();
        $route = '/' . $request->path() . '/';
        $user_perfil = $user->perfil;
        $perfilesModulos = $user_perfil->perfilmodulo->pluck('Modulo_idModulo')->toArray();

        $modulos = Modulo::whereIn('idModulo',$perfilesModulos);


        $hasAccess = !empty(array_filter(
            $modulos->pluck('Modulo_ruta')->toArray(), 
            function($ruta) use($route){return fnmatch($ruta,$route);}
            )
        );
        

        if(!$hasAccess){
            return response('No autorizado',403);
        }

        return $next($request);
    }
}
