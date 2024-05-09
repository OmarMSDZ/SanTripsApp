<?php
// CategoriasPaquetesController.php

namespace App\Http\Controllers;

use App\Models\Categorias_paquetes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriasPaquetesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriaspaquetes = Categorias_paquetes::paginate(5);
        return view('admin.admincategoriapaquetes.admincategoriapaquetes', compact('categoriaspaquetes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admincategoriapaquetes.admincategoriapaquetes_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Categoriapaq' => 'required|max:15'
        ]);

        Categorias_paquetes::create($request->only('Categoriapaq'));

        Session::flash('mensaje', 'Registro Creado Con Exito!');
        return redirect()->route('Categorias_paquetes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorias_paquetes $categorias_paquetes)
    {
        // Implement show method
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorias_paquetes $categorias_paquetes)
    {
        return view('admin.admincategoriapaquetes.admincategoriapaquetes_form', compact('categorias_paquetes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorias_paquetes $categorias_paquetes)
    {
        $request->validate([
            'Categoriapaq' => 'required|max:15'
        ]);

        $categorias_paquetes->update($request->only('Categoriapaq'));

        Session::flash('mensaje', 'Registro Actualizado Con Exito!');
        return redirect()->route('Categorias_paquetes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorias_paquetes $categorias_paquetes)
    {
        $categorias_paquetes->delete();
        Session::flash('mensaje', 'Registro Eliminado Con Exito!');
        return redirect()->route('Categorias_paquetes.index');
    }
}