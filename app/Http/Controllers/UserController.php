<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TipoDocumento;
use App\Models\PersonaDocumento;
use App\Models\PersonaContacto;
use App\Models\Perfil;
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
        if(isset($request->query) && isset($request->search_by))
        {
            switch($request->search_by){
                case "id":
                    $usuarios = User::find($request->query);
                    break;
                case "dni":
                    $usuarios = PersonaDocumento::where(
                        "PersonaDocumento_desc",$request->q)
                        ->first()
                        ->persona
                        ->usuario
                        ->paginate(1);
                    break;
                case "email":
                    $usuarios = User::where("email", $request->query);
                    break;
            }
        }
        else{
            $usuarios = User::paginate(5);
        }
        // $perfiles = Perfil::all();
        return view('gestion.users.index', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $tiposDocumento = TipoDocumento::all();
        $perfiles = Perfil::all();

        return view('gestion.users.create', compact('tiposDocumento', 'perfiles'));
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
            'name' => 'string',
            'apellido' => 'string',
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
			DB::commit();
        } catch (Throwable $e){
            DB::rollBack();
            
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
    public function destroy(User $user)
    {
        //
    }
}
