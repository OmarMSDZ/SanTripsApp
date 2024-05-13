<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.adminempleados');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */

     public function store(Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha guardado de forma correcta";

        try {

            // return $request;
            //ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;

            // $request->validate([
            //     'nombre_destino' => 'required',
            //     'provincia' => 'required',
            //     'abierto_hasta' => 'required',
            //     'abierto_desde' => 'required',
            // ]);

            $empleado = new Empleados();
            $empleado->Cedula = $request->cedula;
            $empleado->Nombres = $request->nombres;
            $empleado->Apellidos = $request->apellidos;
            $empleado->Telefono = $request->telefono;
            $empleado->Email = $request->email;
            $empleado->Fecha_ingreso = $request->fechaingreso;
            $empleado->Fecha_salida = isset($request->fechasalida) ? $request->fechasalida : null;
            $empleado->Estado = isset($request->estado) ? $request->estado : null;
            $empleado->LicenciaConducir = $request->LicenciaConducir;
            // $empleado->creado_por = $usuario_id;
            $empleado->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleados $empleados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleados $empleados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleados $empleados)
    {
        //
    }
}
