<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
//use App\Models\CanchaEstado;
use App\Models\TipoCancha;
use App\Models\PrecioCancha;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Throwable;

class CanchaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $canchas = Cancha::with('precioActual')->get();

        return view('canchas',['canchas' => $canchas]);
    }

    function showGestion()
    {
        $canchas = Cancha::with('preciocancha')->get();

        return view('gestion.cancha.index',['canchas' => $canchas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $tiposCancha = TipoCancha::all();
        return view('gestion.cancha.create',['tiposCancha' => $tiposCancha]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'Cancha_cantidad_max_personas' => 'required|numeric|min:1',
            'Cancha_precio_hora' => 'required|numeric|min:1',
            'rela_tipocancha' => 'required|numeric|min:1',
        ]);

        try
        {
            DB::beginTransaction();
            $cancha = new Cancha;
            $cancha->Cancha_cantidad_max_personas = $request['Cancha_cantidad_max_personas'];
            $cancha->rela_TipoCancha = $request['rela_tipocancha'];
            $cancha->rela_CanchaEstado = 1;
            $cancha->save();

            $precioCancha = PrecioCancha::create([

            ]);
            DB::commit();

            return redirect('/gestion/canchas');
        } catch (Throwable $e){
            DB::rollBack();
        }

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
    public function edit($id_cancha)
    {
        //
        $cancha = Cancha::where('id_cancha',$id_cancha)->first();
        $tiposCancha = TipoCancha::all();
        return view('gestion.cancha.edit',["cancha" => $cancha, 'tiposCancha' => $tiposCancha]);
    }

    function editPrecio()
    {
        $canchas = Cancha::with('precioActual')->get();

        return view('gestion.cancha.actualizar-precio', compact('canchas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_cancha)
    {
        //
        $request->validate([
            'Cancha_cantidad_max_personas' => 'required|numeric|min:1',
            'Cancha_precio_hora' => 'required|numeric|min:1',
            'rela_tipocancha' => 'required|numeric|min:1',
        ]);

        $cancha = Cancha::find($id_cancha);

        $cancha->Cancha_cantidad_max_personas = $request->Cancha_cantidad_max_personas;
        $cancha->rela_tipocancha = $request->rela_tipocancha;

        $cancha->precioActual->fecha_fin = now()->format('Y-m-d');
        $cancha->save();
        $cancha->precioActual->save();

        $precioCancha = PrecioCancha::create([
            'fecha_inicio' => now()->format('Y-m-d'),
            'precio' => $request->Cancha_precio_hora,
            'rela_cancha' => $cancha->id_cancha,
        ]);



        return redirect('/gestion/canchas/')->with('status', 'Se ha actualizado con éxito');
    }


    function updatePrecios(Request $request)
    {
        $request->validate([
            'porcentaje' => 'required|numeric',
        ]);

        if($request->porcentaje === 0.0)
        {
            return redirect('/gestion/canchas/')->with('status', 'Se ha actualizado con éxito');
        }

        $canchas = Cancha::with('precioActual')->get();
        $porcentaje = $request->porcentaje;

        foreach($canchas as $cancha)
        {
            $precioActual = $cancha->precioActual;
            $precioActual->fecha_fin = now()->format('Y-m-d');
            $precioActual->save();

            PrecioCancha::create([
                'precio' => $precioActual->precio + ($precioActual->precio * ($porcentaje / 100)),
                'fecha_inicio' => now()->format('Y-m-d'),
                'rela_cancha' => $cancha->id_cancha,
            ]);
        }

        return redirect('/gestion/canchas/')->with('status', 'Se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cancha $cancha)
    {
        //
    }
}
