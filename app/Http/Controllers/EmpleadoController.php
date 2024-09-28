<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    //
    function index()
    {
        $empleados = Empleado::all();

        return view('gestion.empleado.index',compact('empleados'));
    }
}
