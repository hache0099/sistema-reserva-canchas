<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestionController extends Controller
{
    //
    function show()
    {
        return view("gestion.index");
    }
}
