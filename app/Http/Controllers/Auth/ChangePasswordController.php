<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    //

    function show(){
        return view('auth.changepassword');
    }

    function changePassword(Request $request)
    {
        
        $request->validate([
            'current_password' => "required",
            'new_password' => "required|min:8",
            'new_password_confirmation' => "required|min:8",
        ]);

        if($request->new_password != $request->new_password_confirmation)
        {
            return back()->withErrors([
                'new_password' => 'Las contraseñas no coinciden',
                'new_password_confirmation' => 'Las contraseñas no coinciden',
            ]);
        }

        if(!Hash::check($request->current_password, Auth::user()->password))
        {
            return back()->withErrors(['current_password' => 'Contraseña incorrecta']);
        }

        $user = User::find(Auth::user()->id_usuario);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()-with('status', 'La contraseña ha sido cambiada con éxito');
    }
}
