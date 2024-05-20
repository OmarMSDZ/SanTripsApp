<?php

namespace App\Http\Controllers;

use App\Models\Cargos_empleado;
use App\Models\Vehiculo_transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class VehiculoTransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //variables a utilizar en el form de admin
        $tipos_vehiculos = DB::select('SELECT id, nombre FROM tipos WHERE tipo="vehiculos"');
        
        $marcas_vehiculos = DB::select('SELECT IdMarcaVehiculo, MarcaVehiculo FROM marca_vehiculo');
        
        $modelos_vehiculos = DB::select('SELECT IdModeloVehiculo, ModeloVehiculo FROM modelo_vehiculo');
        
        return view('admin.adminvehiculos', compact('tipos_vehiculos','marcas_vehiculos','modelos_vehiculos'));

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
            
            $vehiculo = new Vehiculo_Transporte();
            $vehiculo->Descripcion = $request->descripcion;
            $vehiculo->Matricula = $request->matricula;
            $vehiculo->FechaIngreso = $request->fechaingreso;
            $vehiculo->CantidadPasajeros = $request->cantidadpasajeros;
            $vehiculo->AnoVehiculo = $request->anovehiculo;
            $vehiculo->Color = $request->color;
            $vehiculo->TipoCombustible = $request->tipocombustible;
            $vehiculo->fk_IdTipoVehiculo = $request->tipovehiculo;
            $vehiculo->fk_IdMarcaVehiculo = $request->marcavehiculo;
            $vehiculo->fk_IdModeloVehiculo = $request->modelovehiculo;
            $vehiculo->Estado = isset($request->estado) ? $request->estado : null;
             
            $vehiculo->save();


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
    public function edit(Vehiculo_transporte $vehiculo_transporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function update($id_vehiculo, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {


            $vehiculo = Vehiculo_transporte::where('IdVehiculo', $id_vehiculo)->first();
            $vehiculo->Descripcion = $request->descripcion;
            $vehiculo->Matricula = $request->matricula;
            $vehiculo->FechaIngreso = $request->fechaingreso;
            $vehiculo->CantidadPasajeros = $request->cantidadpasajeros;
            $vehiculo->AnoVehiculo = $request->anovehiculo;
            $vehiculo->Color = $request->color;
            $vehiculo->TipoCombustible = $request->tipocombustible;
            $vehiculo->fk_IdTipoVehiculo = $request->tipovehiculo;
            $vehiculo->fk_IdMarcaVehiculo = $request->marcavehiculo;
            $vehiculo->fk_IdModeloVehiculo = $request->modelovehiculo;
            $vehiculo->Estado = isset($request->estado) ? $request->estado : null;
             
            $vehiculo->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function getVehiculo($id_vehiculo, Request $request) {

        $data = Vehiculo_transporte::select(
                                'IdVehiculo',
                                'Descripcion AS descripcion',
                                'Matricula AS matricula',
                                'FechaIngreso AS fechaingreso',
                                'CantidadPasajeros AS cantidadpasajeros',
                                'AnoVehiculo AS anovehiculo',
                                'Color AS color',
                                'TipoCombustible AS tipocombustible',
                                
                                'fk_IdTipoVehiculo AS idtipovehiculo',
                                'fk_IdMarcaVehiculo AS idmarcavehiculo',
                                'fk_IdModeloVehiculo AS idmodelovehiculo',
                                
                                'Estado AS estado',
                            )
                            ->where('IdVehiculo', $id_vehiculo)->first();

                            if ($request->has('estado')) {
                                $data->where('vehiculo_transporte.Estado', $request->input('estado'));
                            }
        

        return response()->json($data);
    }

    public function getVehiculos(Request $request) {

  

        $data = DB::table('vehiculo_transporte as v')->
        select(
            'v.IdVehiculo as id',
            'v.Descripcion AS descripcion',
            'v.Matricula AS matricula',
            'v.FechaIngreso AS fechaingreso',
            'v.CantidadPasajeros AS cantidadpasajeros',
            'v.AnoVehiculo as anovehiculo',
            'v.Color as color',
            'v.TipoCombustible as tipocombustible',
            
            'tip.nombre as tipovehiculo',
            'marc.MarcaVehiculo as marcavehiculo',
            'model.ModeloVehiculo as modelovehiculo',
            
            'v.Estado AS estado',
        )       
        ->join('tipos as tip', 'tip.id', '=', 'v.fk_IdTipoVehiculo')
        ->join('marca_vehiculo as marc', 'marc.IdMarcaVehiculo', '=', 'v.fk_IdMarcaVehiculo')
        ->join('modelo_vehiculo as model', 'model.IdModeloVehiculo', '=', 'v.fk_IdModeloVehiculo')
        
        // ->where('tip.tipo', 'vehiculos')

        ->get();

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

    
    public function cambiarVehiculo($id_vehiculo, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {
 

            $vehiculos = Vehiculo_transporte::where('IdVehiculo', $id_vehiculo)->first();
            $vehiculos->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
           
            $vehiculos->save();

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function destroy($id_vehiculo)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Registro eliminado correctamente";
    
        try {
            $vehiculo = Vehiculo_transporte::findOrFail($id_vehiculo);
            $vehiculo->delete();
        } catch (\Exception $e) {
            $return->message = $e->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }
    


}
