<?php

namespace App\Http\Controllers;

use App\Models\VehiculoEmpleado;
use Illuminate\Http\Request;

class VehiculoEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.asignarvehiculoempleado');
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
    public function show(VehiculoEmpleado $vehiculoEmpleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehiculoEmpleado $vehiculoEmpleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehiculoEmpleado $vehiculoEmpleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehiculoEmpleado $vehiculoEmpleado)
    {
        //
    }
}
