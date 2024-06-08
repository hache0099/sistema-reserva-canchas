<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
//use App\Models\CanchaEstado;
//use App\Models\TipoCancha;
use Illuminate\Http\Request;

class CanchaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $canchas = Cancha::all();

        return view('canchas',['canchas' => $canchas]);
    }

    function showGestion()
    {
        $canchas = Cancha::all();

        return view('gestion.cancha.index',['canchas' => $canchas]);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Cancha $cancha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cancha $cancha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cancha $cancha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cancha $cancha)
    {
        //
    }
}
