<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perfil;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $usuarios = User::paginate(5);;
        
        // $perfiles = Perfil::all();
        return view('gestion.users.index', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->fecha_alta = date("Ymd");
        $user->rela_persona = $request->rela_persona;
        $user->rela_perfil = $request->rela_perfil;
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
