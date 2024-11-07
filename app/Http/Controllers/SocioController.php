<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Socio;
use App\Models\PrecioMembresia;
use App\Models\MembresiaMes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SocioController extends Controller
{
    //
    private function getUserPerfil($id = null) : string
    {
        $user_perfil = User::find(
            isset($id) ?
            $id :
            Auth::user()->id_usuario
            )
            ->perfil
            ->Perfil_descripcion;

        return $user_perfil;
    }

    function mostrarUnirse()
    {
        $precioMembresiaActual = PrecioMembresia::latest('fecha_desde')->first()->precio;
        return view("socios.index", compact('precioMembresiaActual'));
    }

    function mostrarAutogestion()
    {
        return view("socios.autogestion");
    }

    function index()
    {
        $user_perfil = $this->getUserPerfil();

        if($user_perfil === "Usuario")
        {
            //TODO
        }

        $socios = User::with(["socio.estadomembresia","persona.personadocumento"])
            ->whereHas("socio")
            ->get();

        return view("gestion.socios.index", compact("socios"));
    }

    function show($socio)
    {

    }

    function nuevoSocio()
    {
        // Obtener usuarios que no son socios (que no existen en la tabla Socio)
        $usuariosNoSocios = User::doesntHave('socio')->get();

        return view('gestion.socios.nuevo-socio', compact('usuariosNoSocios'));
    }

    public function hacerSocio($id)
    {
        // Obtener el usuario por ID
        $usuario = User::findOrFail($id);

        // Crear una nueva entrada en la tabla Socio
        $nuevoSocio = Socio::create([
            'rela_usuario' => $usuario->id_usuario,
            'Socio_fecha_alta' => now()->format('Y-m-d'),
        ]);

        // Crear un pago pendiente en la tabla MembresiaMes
        MembresiaMes::create([
            'rela_socio' => $nuevoSocio->id_socio,
            'monto_a_pagar' => 5000,
            'mes' => now()->format('m'),
            'anio' => now()->format('Y'),
            'rela_PrecioMembresia' => 1,
        ]);

        // Redireccionar de nuevo a la lista con un mensaje de éxito
        return redirect('/gestion/socios')->with('success', 'Usuario hecho socio exitosamente.');
    }


    function store(Request $request)
    {
        $membresia = Socio::create([
            "Socio_fecha_alta" => now()->format("Y-m-d"),
            "rela_usuario" => Auth()::user()->id_usuario,
        ]);

        return redirect('socios.autogestion');
    }
}
