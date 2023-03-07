<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::with('cliente')->get();
        return inertia('servicios/Index', [
            'servicios' => $servicios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::get();
        
        return inertia('servicios/Form', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nombre' => 'required|min:4|string',
            'cliente_id' =>  'required|numeric',
            'imagen' =>  'string|nullable',
            'tipo_servicio' => 'required|string',
            'fecha_inicio' => 'required|string|date',
            'fecha_fin' => 'required|string|date',
            'observaciones' => 'string',
        ]);

        if(!$request->prevalidate){
            $validateData['fecha_inicio'] = Carbon::parse($request->fecha_inicio);
            $validateData['fecha_fin'] = Carbon::parse($request->fecha_fin);
            Servicio::create($validateData);
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        $clientes = Cliente::get();
        
        return inertia('servicios/Form', [
            'clientes' => $clientes,
            'servicio' => $servicio
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        $validateData = $request->validate([
            'nombre' => 'required|min:4|string',
            'cliente_id' =>  'required|numeric',
            'imagen' =>  'string|nullable',
            'tipo_servicio' => 'required|string',
            'fecha_inicio' => 'required|string|date',
            'fecha_fin' => 'required|string|date',
            'observaciones' => 'string',
        ]);

        if(!$request->prevalidate){
            $validateData['fecha_inicio'] = Carbon::parse($request->fecha_inicio);

            $validateData['fecha_fin'] = Carbon::parse($request->fecha_fin);

            $servicio->update($validateData);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
    }
}
