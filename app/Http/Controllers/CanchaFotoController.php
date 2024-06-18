<?php

namespace App\Http\Controllers;

use App\Models\CanchaFoto;
use App\Models\Cancha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class CanchaFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $canchas = Cancha::with('canchafoto')->get();
        return view('gestion.fotoscancha.index', compact('canchas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_cancha)
    {
        //
        return view('gestion.fotoscancha.create', compact('id_cancha'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $canchaId)
    {
        $request->validate([
            'CanchaFoto_ruta' => 'required|image|max:2048',
        ]);

        $path = $request->file('CanchaFoto_ruta')->store('img/canchas','public');
        
        if (! $path)
        {
            return (back()->withErrors('No se pudo subir la imagen'));
        }

        $foto = new CanchaFoto();
        $foto->CanchaFoto_ruta = $path;
        $foto->Cancha_id_cancha = $canchaId;
        $foto->save();

        return redirect('/gestion/fotos-canchas')->with('success', 'Foto agregada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CanchaFoto $canchaFoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CanchaFoto $canchaFoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CanchaFoto $canchaFoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CanchaFoto $canchaFoto)
    {
        //
    }
}
