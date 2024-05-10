<?php

namespace App\Http\Controllers;

use App\Models\Cargos_empleado;
use Illuminate\Http\Request;

class CargosEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return view('admin.admincargospuestos');
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
    public function show(Cargos_empleado $cargos_empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cargos_empleado $cargos_empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cargos_empleado $cargos_empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cargos_empleado $cargos_empleado)
    {
        //
    }
}
