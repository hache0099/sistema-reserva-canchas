<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Persona;
use App\Models\Domicilio;
use App\Models\TipoDomicilio;
use App\Models\TipoDocumento;
use App\Models\TipoContacto;
use App\Models\PersonaDocumento;
use App\Models\PersonaContacto;
use App\Models\Perfil;
use App\Models\Empleado;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $request->validate([
            'q' => 'string',
            'search_by' => 'string',
        ]);

        $usuarios = null;
        if (isset($request->q) && isset($request->search_by)) {
        switch ($request->search_by) {
            case "id":
                $usuario = User::find($request->q); // Cambia de query a q
                $usuarios = $usuario ? collect([$usuario]) : collect([]); // Siempre devuelve una colección
                break;
            case "dni":
                $documento = PersonaDocumento::where("PersonaDocumento_desc", $request->q)->first();
                $usuarios = $documento ? $documento->persona->usuario()->paginate(1) : collect([]); // Asegura que sea una colección paginada
                break;
            case "email":
                $usuarios = User::where("email", $request->q)->paginate(1); // Cambia de query a q
                break;
            case "nombre":
                $usuarios = User::where("name", 'LIKE', '%' . $request->q . '%')->paginate(5); // Búsqueda por nombre
                break;
            case "apellido":
                $usuarios = User::where("apellido", 'LIKE', '%' . $request->q . '%')->paginate(5); // Búsqueda por apellido
                break;
            default:
                $usuarios = User::paginate(5); // Default a mostrar todos los usuarios con paginación
                break;
            }
        } else {
            $usuarios = User::paginate(5); // Si no hay búsqueda, devuelve la paginación normal
        }

        return view('gestion.users.index', ['usuarios' => $usuarios]);
    }


    function obtenerUsuarioPorEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if($user !== null)
        {
            echo json_encode([
            'resultado' => true,
            'user' => $user
            ]);
            return;
        }

        echo json_encode(['resultado' => false]);
    }

    function obtenerUsuarioPorDNI(Request $request)
    {
        $user = PersonaDocumento::where('PersonaDocumento_desc', $request->dni)
            ->first()
            ;
        
        if($user)
        {
            $newUser = $user->persona;
            echo json_encode([
            'resultado' => true,
            'user' => $newUser,
            ]);
            return;
        }

        echo json_encode(['resultado' => false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $tiposDocumento = TipoDocumento::all();
        $perfiles = Perfil::all();
        $perfilACrear = null;
        
        if(isset($request->perfilACrear))
        {
            $perfilACrear = $request->perfilACrear;
        }

        return view('gestion.users.create', compact('tiposDocumento', 'perfiles', 'perfilACrear'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'email' => 'required|email',
            'dni' => 'required|numeric',
            'perfil' => 'required|numeric|min:1',
            'telefono' => 'required|numeric',
            'name' => 'nullable|string',
            'apellido' => 'nullable|string',
        ]);

        $userExists = User::where('email', $request->email)->exists();
        $dniExists = PersonaDocumento::where('PersonaDocumento_desc', $request->dni)->exists();

        if($userExists || $dniExists)
        {
            return back()->withErrors(['already exists' => 'el email o dni ya está registrado']);
        }
        
        try{
            DB::beginTransaction();
			$persona = Persona::create([
				'Nombre' => $request->name,
				'Apellido' => $request->apellido,
				//'Telefono' => $request->telefono,
				//'FechaNacimiento' => $request->fechanac,
			]);

			$domicilio = Domicilio::create([
				'rela_persona' => $persona->id_persona,
			]);

			$persona_doc = PersonaDocumento::create([
				'PersonaDocumento_desc' => $request->dni,
				'Persona_id_persona' => $persona->id_persona,
				'TipoDocumento_id_TipoDocumento' => $request->tipodni,
			]);

			$persona_contacto = PersonaContacto::create([
				'PersonaContacto_desc' => $request->telefono,
				'rela_persona' => $persona->id_persona,
				'rela_tipocontacto' => TipoContacto::where('Contacto_descripcion', 'Telefono')
					->first()->idContacto,
			]);
			
			$user = User::create([
				'email' => $request->email,
				'password' => $request->dni,
				'rela_persona' => $persona->id_persona,
				'rela_perfil' => $request->perfil,
				'fecha_alta' => now()->format('Y-m-d'),
			]);

            if($request->perfil == Perfil::where(Perfil_descripcion, 'empleado')->idPerfil)
            {
                Empleado::create([
                    'codigo_legajo' => $user->id_usuario,
                    'fecha_alta_empleado' => now()->format('Y-m-d'),
                    'rela_usuario' => $user->id_usuario,
                ]);
            }
			
			DB::commit();

            
			
			return redirect('/gestion/usuarios')->with('status', 'se ha creado el usuario con éxito');
        } catch (Throwable $e){
            DB::rollBack();
            return back()->withErrors(['error', $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $usuario = Auth::user();
        $persona = $usuario->persona;

        return view("user.profile",
        ["user" => $usuario,
		"persona" => $persona]);
    }


    function resetPassword($id_usuario)
    {
        $user = User::find($id_usuario);
        $dni = $user->persona->personadocumento->PersonaDocumento_desc;
        
        $user->password = $dni;
        $user->password_changed = 0;
        $user->save();

        return redirect("/gestion/usuarios");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    function editPermisos($id_usuario)
    {
        $user = User::find($id_usuario);
        $perfiles = Perfil::all();

        return view('gestion.users.edit', ['usuario' => $user, 'perfiles' => $perfiles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    function updatePermisos(Request $request,$id_usuario)
    {
        $request->validate([
            'rela_perfil' => 'required|int|min:1'
        ]);

        $user = User::find($id_usuario);
        $user->rela_perfil = $request['rela_perfil'];

        $user->save();

        return redirect('/gestion/usuarios')->with('status', 'Se ha actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_usuario)
    {
        //
        $user = User::find($id_usuario);

        $user->estado = 0;
        $user->save();
    }
}
