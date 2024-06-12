<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TipoDocumento;
use Throwable;

class TipoDocumentoController extends Controller
{
    //
    function index()
    {
        $tiposDocumento = TipoDocumento::all();
        return view("gestion.tipodoc.index",['tiposDocumento' => $tiposDocumento]);
    }

    function edit(int $id_tipodoc)
    {
        $tipoDoc = TipoDocumento::find($id_tipodoc);

        return view('gestion.tipodoc.edit',['tipoDocumento' => $tipoDoc]);
    }

    function update(Request $request, $id_tipodoc)
    {
        $request->validate([
            'TipoDocumento_desc' => 'required|string',
        ]);

        try
        {
            DB::beginTransaction();
            $tipoDoc = TipoDocumento::find($id_tipodoc);

            $tipoDoc->TipoDocumento_desc = $request['TipoDocumento_desc'];
            $tipoDoc->save();
            DB::commit();

            return redirect('/gestion/tipos-documento')->with('status','La actualización ha sido exitosa');
        } catch (Throwable $e)
        {
            DB::rollBack();
        }
    }

    function create()
    {
        return view('gestion.tipodoc.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'TipoDocumento_desc' => 'required|string',
        ]);

        
    }
}
