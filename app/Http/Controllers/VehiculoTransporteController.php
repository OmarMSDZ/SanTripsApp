<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo_transporte;
use Illuminate\Http\Request;

class VehiculoTransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.adminvehiculos');
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
    public function show(Vehiculo_transporte $vehiculo_transporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo_transporte $vehiculo_transporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo_transporte $vehiculo_transporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo_transporte $vehiculo_transporte)
    {
        //
    }
}
