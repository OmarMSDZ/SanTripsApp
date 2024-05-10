<?php

namespace App\Http\Controllers;

use App\Models\Ofertas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class OfertasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index del controlador
        $ofertas = Ofertas::paginate(5);
        return view('admin.adminofertas.adminofertas', compact('ofertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.adminofertas.adminofertas_form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'Descripcion' => 'required',
            'Porcentaje' => 'required|gte:1',
            'FechaDesde' => 'required',
            'FechaHasta' => 'required'
            
        ]);

        Ofertas::create($request->only('Descripcion', 'Porcentaje','FechaDesde','FechaHasta'));

        Session::flash('mensaje', 'Registro Creado Con Exito!');
        return redirect()->route('Ofertas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ofertas $ofertas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ofertas $ofertas)
    {
        //
        return view('admin.adminofertas.adminofertas_form', compact('ofertas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ofertas $ofertas)
    {
        //
         $request->validate([
            'Descripcion' => 'required',
            'Porcentaje' => 'required|gte:1',
            'FechaDesde' => 'required',
            'FechaHasta' => 'required'
            
        ]);

        $ofertas->update($request->only('Descripcion', 'Porcentaje','FechaDesde','FechaHasta'));

        Session::flash('mensaje', 'Registro Actualizado Con Exito!');
        return redirect()->route('Ofertas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ofertas $ofertas)
    {
        //

        $ofertas->delete();
        Session::flash('mensaje', 'Registro Eliminado Con Exito!');
        return redirect()->route('Ofertas.index');


    }
}
