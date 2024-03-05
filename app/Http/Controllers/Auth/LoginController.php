<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    function showLogin(){
		return view('auth/login');
	}
    
    function login(Request $request)
    {
		$this->validate($request, [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
		]);

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			return redirect()->intended(route('home'));
		}

		return back()->withErrors(['email' => 'Las credenciales no coinciden.']);
	}
}
