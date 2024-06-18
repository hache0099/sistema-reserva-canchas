<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodosPago = MetodoPago::all();
        return view('gestion.metodopago.index', compact('metodosPago'));
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
    public function show(MetodoPago $metodoPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $metodoPago = MetodoPago::find($id);
        return view('gestion.metodopago.edit', compact('metodoPago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetodoPago $metodoPago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //
        $metodoPago = MetodoPago::find($id);
        $metodoPago->estado = 0;
        $metodoPago->save();
        
        return redirect('/gestion/metodos-pago')->with('status', 'Se ha deshabilitado exitosamente');
    }

    public function restore($id)
    {
        //
        $metodoPago = MetodoPago::find($id);
        $metodoPago->estado = 1;
        $metodoPago->save();
        
        return redirect('/gestion/metodos-pago')->with('status', 'Se ha habilitado exitosamente');
    }
}
