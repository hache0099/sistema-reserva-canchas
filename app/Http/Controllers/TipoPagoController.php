<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPago;

class TipoPagoController extends Controller
{
    public function index()
    {
        $tiposPago = TipoPago::all();
        return view('gestion.tipopago.index', compact('tiposPago'));
    }

    public function create()
    {
        return view('gestion.tipopago.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TipoPago_desc' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        TipoPago::create($request->all());

        return redirect()->route('tipopago.index')->with('success', 'Tipo de pago creado exitosamente.');
    }

    public function edit($id)
    {
        $tipoPago = TipoPago::find($id);
        return view('gestion.tipopago.edit', compact('tipoPago'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TipoPago_desc' => 'required|string|max:255',
            //~ 'estado' => 'required|boolean',
        ]);

        $tipoPago = TipoPago::find($id);
        $tipoPago->update($request->all());

        return redirect()->route('tipopago.index')->with('success', 'Tipo de pago actualizado exitosamente.');
    }

    function delete($id)
    {
        $tipoPago = TipoPago::find($id);
        $tipoPago->estado = 0;
        $tipoPago->save();

        return redirect()->route('tipopago.index')->with('success', 'Tipo de pago actualizado exitosamente.');
    }

    function restore($id)
    {
        $tipoPago = TipoPago::find($id);
        $tipoPago->estado = 1;
        $tipoPago->save();

        return redirect()->route('tipopago.index')->with('success', 'Tipo de pago actualizado exitosamente.');
    }
}
