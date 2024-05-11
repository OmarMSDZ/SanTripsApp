<?php

namespace App\Http\Controllers;

use App\Models\Paquetes_turisticos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaquetesTuristicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $paquetes_turisticos = Paquetes_turisticos::select(
            'paquetes_turisticos.idPaquete as IdPaquete',
            'paquetes_turisticos.Nombre as Nombre',
            'paquetes_turisticos.Descripcion as Descripcion',
            'paquetes_turisticos.Costo as Costo',
            'paquetes_turisticos.Num_personas as Numpersonas',
            'paquetes_turisticos.Edades as Edades',
            'paquetes_turisticos.Idiomas as Idiomas',
            'paquetes_turisticos.Alojamiento as Alojamiento',
            'paquetes_turisticos.Tiempo_estimado as Tiempo_estimado',
            'paquetes_turisticos.Disponibilidad as Disponibilidad',
            'categorias_paquetes.CategoriaPaq as Categoria',
            'ofertas.Descripcion as Descoferta'
        )
        ->join('categorias_paquetes', 'paquetes_turisticos.fk_IdCategoriaPaq', '=', 'categorias_paquetes.IdCategoriaPaq')
        ->join('ofertas', 'paquetes_turisticos.fk_IdOferta', '=', 'ofertas.IdOferta')
        ->paginate(5);


        return view('admin.adminpaquetes.adminpaquetes', compact('paquetes_turisticos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.adminpaquetes.adminpaquetes_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validatedData = $request->validate([
            'Nombre' => 'required',
            'Descripcion' => 'required',
            'Costo' => 'required',
            'Num_personas' => 'required',
            'Edades' => 'required',
            'Idiomas' => 'required',
            'Alojamiento' => 'required',
            'Tiempo_estimado' => 'required',
            'Disponibilidad' => 'required',
            'Categoria' => 'required',
            'Ofertas' => 'required'
            
            
            
        ]);
         
       

       Paquetes_turisticos::create($request->only('Nombre','Descripcion', 'Costo','Num_personas', 'Edades','Idiomas','Alojamiento','Tiempo_estimado','Disponibilidad','Categoria','Ofertas') + [
            'fk_IdCategoriapaq' => $request->input('Categoria'),
            'fk_IdOferta' => $request->input('Ofertas') 
        ]);


        // Session::flash('mensaje', 'Registro Creado Con Exito!');
        return redirect()->route('Paquetes.index')->with('success', 'Reserva creada correctamente.');


    }

    /**
     * Display the specified resource.
     */
    public function show(Paquetes_turisticos $paquetes_turisticos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paquetes_turisticos $paquetes_turisticos)
    {
        //
        return view('admin.adminpaquetes.adminpaquetes_form', compact('paquetes_turisticos'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paquetes_turisticos $paquetes_turisticos)
    {
        //
        $validatedData = $request->validate([
            'Nombre' => 'required',
            'Descripcion' => 'required',
            'Costo' => 'required',
            'Num_personas' => 'required',
            'Edades' => 'required',
            'Idiomas' => 'required',
            'Alojamiento' => 'required',
            'Tiempo_estimado' => 'required',
            'Disponibilidad' => 'required',
            'Categoria' => 'required',
            'Ofertas' => 'required'
            
            
            
        ]);

        $paquetes_turisticos->update($request->only('Nombre','Descripcion', 'Costo','Numero_personas', 'Edades','Idiomas','Alojamiento','Tiempo_estimado','Diponibilidad','Categoria','Ofertas') + [
            'fk_IdCategoriapaq' => $request->input('Categoria'),
            'fk_IdOferta' => $request->input('Ofertas') 
        ]);

        Session::flash('mensaje', 'Registro Actualizado Con Exito!');
        return redirect()->route('Paquetes.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paquetes_turisticos $paquetes_turisticos)
    {
        //

        $paquetes_turisticos->delete();
        Session::flash('mensaje', 'Registro Eliminado Con Exito!');
        return redirect()->route('Paquetes.index');


    }
}
