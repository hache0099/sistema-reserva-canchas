<?php

namespace App\Http\Controllers;

use App\Models\TipoDomicilio;
use Illuminate\Http\Request;

class TipoDomicilioController extends Controller
{
    public function index()
    {
        $tiposDomicilio = TipoDomicilio::all();
        return view('gestion.tipodomicilio.index', compact('tiposDomicilio'));
    }

    public function create()
    {
        return view('gestion.tipodomicilio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TipoDomicilio_desc' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        TipoDomicilio::create($request->all());

        return redirect('/gestion/tipos-domicilio')->with('success', 'Tipo de domicilio creado exitosamente.');
    }

    public function edit($id)
    {
        $tipoDomicilio = TipoDomicilio::find($id);
        return view('gestion.tipodomicilio.edit', compact('tipoDomicilio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TipoDomicilio_desc' => 'required|string|max:255',
            //'estado' => 'required|boolean',
        ]);

        $tipoDomicilio = TipoDomicilio::find($id);
        $tipoDomicilio->update($request->all());

        return redirect('/gestion/tipos-domicilio')->with('success', 'Tipo de domicilio actualizado exitosamente.');
    }
    
    function delete($id)
    {
		$tipoDomicilio = TipoDomicilio::find($id);
		$tipoDomicilio->estado = 0;
		$tipoDomicilio->save();
		
		return redirect('/gestion/tipos-domicilio')->with('success', 'Tipo de domicilio actualizado exitosamente.');
	}
	
	function restore($id)
    {
		$tipoDomicilio = TipoDomicilio::find($id);
		$tipoDomicilio->estado = 1;
		$tipoDomicilio->save();
		
		return redirect('/gestion/tipos-domicilio')->with('success', 'Tipo de domicilio actualizado exitosamente.');
	}


}
