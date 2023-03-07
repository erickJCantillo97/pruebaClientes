<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return inertia('clientes/Index', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('clientes/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nombre' => 'required|min:4|string',
            'imagen' =>  'string|nullable',
            'cedula' =>  'string|required|unique:clientes,cedula',
            'correo' => 'required|string|email',
            'telefono' => 'required|string|numeric',
            'observaciones' => 'string|string',
        ]);

        if(!$request->prevalidate){
            Cliente::create($validateData);
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $servicios = $cliente->servicios;
        return inertia('clientes/show', [
            'clientes' => $cliente,
            'servicios' => $servicios,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return inertia('clientes/Form', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
         $validateData = $request->validate([
            'nombre' => 'required|min:4|string',
            'imagen' =>  'string|nullable',
            'cedula' =>  'string|required|unique:clientes,cedula,'.$cliente->id,
            'correo' => 'required|string|email',
            'telefono' => 'required|string|numeric',
            'observaciones' => 'string|string',
        ]);

        if(!$request->prevalidate){
            $cliente->update($validateData);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
    }
}
