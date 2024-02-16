<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    //
    public function getPersona($id)
    {
		return Persona::findOrFail($id);
	}
}
