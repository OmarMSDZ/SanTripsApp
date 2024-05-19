<?php

namespace App\Http\Controllers;

use App\Models\Cargos_empleado;
use App\Models\Ofertas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class OfertasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $cargos_empleado = Cargos_empleado::select('IdCargo', 'Cargo')->get();

        // $cargos_empleado = DB::select('Select IdCargo, Cargo from cargos_empleado');
        
        // return view('admin.adminempleados', compact('cargos_empleado'));
        
        return view('admin.adminofertas');

        

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

        //codigo para guardar informacion 

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha guardado de forma correcta";

        try {

        
            //ID DEL USUARIO LOGUEADO, PARA CONTROLAR QUIEN INGRESA/ACTUALIZA DATOS
            $usuario_id = Auth::user()->id;

            $oferta = new Ofertas();
            
            $oferta->Descripcion = $request->descripcion;
            $oferta->Porcentaje = $request->porcentaje;
            $oferta->FechaDesde = $request->fechadesde;
            $oferta->FechaHasta = $request->fechahasta;
            $oferta->Estado = isset($request->estado) ? $request->estado : null;
            
            $oferta->creado_por = $usuario_id;
            $oferta->save();


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
    public function edit(Ofertas $ofertas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function update($id_oferta, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            // return $request;
            //ID DEL USUARIO LOGUEADO, PARA CONTROLAR QUIEN INGRESA/ACTUALIZA DATOS
            $usuario_id = Auth::user()->id;

            $oferta = Ofertas::where('IdOferta', $id_oferta)->first();
            $oferta->Descripcion = $request->descripcion;
            $oferta->Porcentaje = $request->porcentaje;
            $oferta->FechaDesde = $request->fechadesde;
            $oferta->FechaHasta = $request->fechahasta;
            $oferta->Estado = isset($request->estado) ? $request->estado : null;
           
            $oferta->actualizado_por = $usuario_id;
            $oferta->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function getOferta($id_oferta, Request $request) {

        $data = Ofertas::select(
                                'IdOferta AS id',
                                'Descripcion AS descripcion',
                                'Porcentaje AS porcentaje',
                                'FechaDesde AS fechadesde ',
                                'FechaHasta AS fechahasta',
                                'Estado AS estado',
                            )
                            ->where('IdOferta', $id_oferta)->first();


        return response()->json($data);
    }

    public function getOfertas(Request $request) {

        $data = Ofertas::
                    select(
                        //tener en cuenta los espacios para que no de error, ya que se consultan los campos incluyendo el espacio
                        'IdOferta AS id',
                                'Descripcion AS descripcion',
                                'Porcentaje AS porcentaje',
                                'FechaDesde AS fechadesde',
                                'FechaHasta AS fechahasta',
                                'Estado AS estado',
                    )->get();

        return datatables()->of($data)
                            ->addColumn('action', function($row) {

                                $btnActivo = $row->estado == 'ACTIVO' ? "<a class='dropdown-item text-danger btnCambiarEstado' estado='$row->estado' nombre='$row->descripcion' href='#!' codigo='$row->id'> <i class='bi bi-x'> </i> Desactivar</a>" : "<a class='dropdown-item text-success btnCambiarEstado' href='#!' estado='$row->estado' nombre='$row->descripcion'  codigo='$row->id'> <i class='bi bi-check2'> </i> Activar</a>";

                                return '<div class="dropstart font-sans-serif position-static d-inline-block">
                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown0">
                                                    <a class="dropdown-item btnMostrar" codigo="'.$row->id.'" href="#!"> <i class="bi bi-card-heading"></i> Mostrar</a>
                                                    <a class="dropdown-item btnActualizar" href="#!" codigo="'.$row->id.'"> <i class="bi bi-pencil-square"></i> Actualizar</a>
                                                    <a class="dropdown-item text-danger btnEliminar" href="#!" codigo="'.$row->id.'"> <i class="bi bi-trash"></i> Eliminar</a>
                                                    <div class="dropdown-divider"></div>
                                                    '. $btnActivo .'
                                            </div>
                                        </div>';
                            })->addColumn('estado', function ($row) {
                                return $row->estado == 'ACTIVO' ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
                            })->rawColumns(['action', 'estado'])->make(true);
    }

    
    public function cambiarOferta($id_oferta, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

           
            $ofertas = Ofertas::where('IdOferta', $id_oferta)->first();
            $ofertas->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            $ofertas->save();

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    
    public function destroy($id_oferta)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Registro eliminado correctamente";
    
        try {
            $oferta = Ofertas::findOrFail($id_oferta);
            $oferta->delete();
        } catch (\Exception $e) {
            $return->message = $e->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }


}
