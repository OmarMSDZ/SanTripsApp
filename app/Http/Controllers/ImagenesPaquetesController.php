<?php

namespace App\Http\Controllers;

use App\Models\Imagenes_paquetes;
use Illuminate\Http\Request;

class ImagenesPaquetesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.adminimagenespaquetes');
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
    public function show(Imagenes_paquetes $imagenes_paquetes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imagenes_paquetes $imagenes_paquetes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imagenes_paquetes $imagenes_paquetes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imagenes_paquetes $imagenes_paquetes)
    {
        //
    }
}
