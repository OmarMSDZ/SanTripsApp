<?php

namespace App\Http\Controllers;

use App\Models\Vehiculos_paquetes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class VehiculosPaquetesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    $id_paquete_turistico = DB::select('Select id, Nombre from paquetes_turisticos');
        //
        $id_tipo_vehiculo = DB::select('Select IdTipoVehiculo, TipoVehiculo from tipo_vehiculo');
        //
        return view('admin.asignarvehiculopaquete', compact('id_paquete_turistico', 'id_tipo_vehiculo'));
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

            $vehiculos_paquetes = new Vehiculos_paquetes();
            $vehiculos_paquetes->IdVehiculosPaquetes = $request->id_vehiculos_paquetes;
            $vehiculos_paquetes->id_paquete_turistico = $request->id_paquete_turistico;
            $vehiculos_paquetes->fk_IdVehiculo = $request->fk_id_vehiculo;


            // Guardar el nuevo registro en la base de datos
               $vehiculos_paquetes->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculos_paquetes $vehiculos_paquetes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculos_paquetes $vehiculos_paquetes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $vehiculos_paquetes)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizar de forma correcta";

        try {

            // return $request;
            //ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;

            // Obtener el registro de vehiculos_paquetes
            //$vehiculos_Paquetes = Vehiculos_paquetes::where('IdVehiculosPaquetes', $id_vehiculos_paquetes)->first();
            $vehiculos_paquetes->id_paquetes_turistico = $request->id_paquetes_turistico;
            $vehiculos_paquetes->fk_IdVehiculo = $request->fk_id_vehiculo;
            // Guardar los cambios
            $vehiculos_paquetes->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }


    public function getVehiculoPaquete($id_vehiculos_paquetes, Request $request) {
        $data =vehiculos_paquetes::select(
                            'IdVehiculosPaquetes AS id_vehiculos_paquetes',
                            'id_paquetes_turistico AS id_paquetes_turistico',
                            'fk_Idvehiculo AS fk_idvehiculo'
                        )
                        ->where('IdVehiculosPaquetes', $id_vehiculos_paquetes)
                        ->first();
    
        return response()->json($data);
    }
    
    public function getVehiculosPaquetes(Request $request) {
        // $data = vehiculos_paquetes::select(
        //                     'IdVehiculosPaquetes AS id_vehiculos_paquetes',
        //                     'id_paquetes_turistico AS id_paquetes_turistico',
        //                     'fk_Idvehiculo AS fk_idvehiculo'
        //                 )->get();

        $data = DB::select("SELECT 
                            vp.IdVehiculosPaquetes,
                            pt.id AS id_paquete_turistico,
                            pt.Nombre AS paquete_turistico,
                            pt.Descripcion AS descripcion,
                            pt.Costo,
                            pt.Edades AS edades,
                            pt.Idiomas AS idiomas,
                            tp.IdTipoVehiculo AS id_tipo_vehiculo,
                            tp.TipoVehiculo AS tipovehiculo,
                            pt.Estado AS estado
                        FROM vehiculos_paquetes AS vp 
                        INNER JOIN paquetes_turisticos AS pt ON pt.id = vp.id_paquete_turistico
                        INNER JOIN tipo_vehiculo AS tp ON tp.IdTipoVehiculo = vp.IdVehiculosPaquetes
                    ");
    
        return datatables()->of($data)
                            ->addColumn('action', function($row) {
                                return '<div class="dropstart font-sans-serif position-static d-inline-block">
                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown0">
                                                <a class="dropdown-item btnMostrar" codigo="'.$row->id_vehiculos_paquetes.'" href="#!"> <i class="bi bi-card-heading"></i> Mostrar</a>
                                                <a class="dropdown-item btnActualizar" href="#!" codigo="'.$row->id_vehiculos_paquetes.'"> <i class="bi bi-pencil-square"></i> Actualizar</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item btnEliminar" href="#!" codigo="'.$row->id_vehiculos_paquetes.'"> <i class="bi bi-trash"></i> Eliminar</a>
                                            </div>
                                        </div>';
                            })->make(true);
    }
     
    public function cambiarEstadoVehiculoPaquete($id_vehiculos_paquetes, Request $request) {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";
    
        try {
            // ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;
    
            // Obtener el registro de vehiculos_paquetes
            $vehiculos_paquetes = vehiculos_paquetes::where('IdVehiculosPaquetes', $id_vehiculos_paquetes)->first();
    
            // Cambiar el estado del registro
            $vehiculos_paquetes->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
    
            // Guardar los cambios
            $vehiculos_paquetes->save();
    
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_vehiculos_paquetes)
{
    $return = new stdClass();
    $return->code = 200;
    $return->message = "Registro eliminado correctamente";

    try {
        DB::beginTransaction();

        // Encuentra el incidente y elimina el registro
        $vehiculos_paquetes = vehiculos_paquetes::findOrFail($id_vehiculos_paquetes);
       

        // Elimina la reserva
        $vehiculos_paquetes->delete();

        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        $return->message = $e->getMessage();
        $return->code = 500;
    }


    return redirect()->route('vehiculos_paquetes.index')->with('success', 'Registro eliminado correctamente');

}
}
