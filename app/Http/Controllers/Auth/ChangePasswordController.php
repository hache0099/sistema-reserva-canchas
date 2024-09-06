<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsuarioToken;
use App\Models\TipoToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    //

    function show(){
        return view('auth.changepassword');
    }

    function generateToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email',$request->email)
            ->with('persona')
            ->get();

        if(!isset($user))
        {
            return back()->withErrors(['emailnotexist' => 'El email no existe']);
        }

        $token_hash = Str::random(60);
        $expireDate = new Datetime();
        $expireDate->add(new DateInterval('PT1H'));

        $token = UsuarioToken::create([
            'token_hash' => $token_hash,
            'expires_at' => $expireDate->format('Y-m-d H:i:s'),
            'rela_usuario' => $user->id_usuario,
            'rela_tipotoken' => TipoToken::where('TipoToken_desc','Cambiar contraseña')
                ->get()
                ->idTipoToken,
        ]);

        Mail::to($user->email)
            ->suject("Cambio de contraseña")
            ->view('emails.ChangePasswordEmail', ['user' => $user, 'token' => $token]);

        return view('auth.pass-email-sended');

    }

    function changePassword(Request $request)
    {

        $request->validate([
            'token' => 'required|string',
            'id' => 'required|number',
            'new_password' => "required|min:8",
            'new_password_confirmation' => "required|min:8",
        ]);

        //TODO: terminar la lógica de verificar el token
        $token = UsuarioToken::where('token_hash',$request->token)
            ->andWhere('expires_at');

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

        return back()->with('status', 'La contraseña ha sido cambiada con éxito');
    }
}
