<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    
    function showLogin(){
		return view('auth/login');
	}
    
    function login(Request $request)
    {
		$credentials = $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
		]);

		//['e-mail' => $request->email, 'pass' => $request->password]
		
		if (Auth::attempt($credentials)) {
			return redirect()->intended(route('home'));
		}
		//~ $user = User::where('email')

		return back()->withErrors(['email' => 'Las credenciales no coinciden.'])->onlyInput('email');
	}
	
	function logout(Request $request){
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		
		return redirect('/');
	}
}
