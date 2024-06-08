<?php

namespace App\Http\Controllers;

use App\Models\TipoCancha;
use Illuminate\Http\Request;

class TipoCanchaController extends Controller
{
    //

    function index()
    {
        $tiposCancha = TipoCancha::all();

        return view('gestion.tipocancha.index', ['tiposCancha' => $tiposCancha]);
    }

    function create()
    {
        return view('gestion.tipocancha.create');
    }

    function store(Request $request)
    {
        //TODO
    }
}
