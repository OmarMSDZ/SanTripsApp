<?php

namespace App\Http\Controllers;

use App\Models\VehiculoEmpleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;


class VehiculoEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id_empleado = DB::select('Select id, Nombres  from empleados');

        //
        $id_tipo_vehiculo = DB::select('Select IdTipoVehiculo, TipoVehiculo from tipo_vehiculo');

        //
        return view('admin.asignarvehiculoempleado', compact('id_empleado', 'id_tipo_vehiculo'));
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
        $return = new stdClass();        $return->code = 200;
        $return->message = "Se ha guardado de forma correcta";
        
        try {    
            // Crear una nueva instancia del modelo AsignacionVehiculo
            $vehiculoEmpleado = new VehiculoEmpleado();
            $vehiculoEmpleado->IdAsignacion = $request->id_asignacion;
            $vehiculoEmpleado->FechaAsignacion = $request->FechaAsignacion;
            $vehiculoEmpleado->id_empleado = $request->id_empleado;
            $vehiculoEmpleado->fk_IdVehiculo = $request->fk_id_vehiculo;
        
            // Guardar el nuevo registro en la base de datos
            $vehiculoEmpleado->save();
        } catch (\Throwable $th) {
            // Capturar cualquier error y ajustar el mensaje de respuesta
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        
        return response()->json($return, $return->code);
        
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
    public function update(Request $request, $vehiculoEmpleado)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";
    
        try {
            // Obtener el registro de asignacion_vehiculo y actualizarlo
            $vehiculoEmpleado->FechaAsignacion = $request->fecha_asignacion;
            $vehiculoEmpleado->id_empleado = $request->id_empleado;
            $vehiculoEmpleado->fk_IdVehiculo = $request->fk_id_vehiculo;
    
            // Guardar los cambios
            $vehiculoEmpleado->save();
        } catch (\Throwable $th) {
            // Capturar cualquier error y ajustar el mensaje de respuesta
            $return->message = $th->getMessage();
            $return->code = 500;
        }
    
        return response()->json($return, $return->code);
    }

    public function getAsignacionVehiculo($id_asignacion, Request $request) {
        $data = vehiculoEmpleado::select(
                            'IdAsignacion AS id_asignacion',
                            'FechaAsignacion AS fecha_asignacion',
                            'id_empleado AS id_empleado',
                            'fk_IdVehiculo AS fk_idvehiculo'
                        )
                        ->where('IdAsignacion', $id_asignacion)
                        ->first();
    
        return response()->json($data);
    }
    
    public function getAsignacionesVehiculos(Request $request) {
        // $data = vehiculoEmpleado::select(
        //                     'IdAsignacion AS id_asignacion',
        //                     'FechaAsignacion AS fecha_asignacion',
        //                     'id_empleado AS id_empleado',
        //                     'fk_IdVehiculo AS fk_idvehiculo'
        //                 )->get();

        $data = DB::select("SELECT 
                            av.IdAsignacion,
                            em.id AS id_empleado,
                            em.Nombres AS empleados,
                            em.Apellidos AS apellidos,
                            em.Telefono,
                            em.Cedula AS cedula,
                            em.Email AS email,
                            tp.IdTipoVehiculo AS id_tipo_vehiculo,
                            tp.TipoVehiculo AS tipovehiculo,
                            em.Estado AS estado
                        FROM asignacion_vehiculo AS av 
                        INNER JOIN empleados AS em ON em.id = av.id_empleado
                        INNER JOIN tipo_vehiculo AS tp ON tp.IdTipoVehiculo = av.IdAsignacion
                    ");
    
        return datatables()->of($data)
                            ->addColumn('action', function($row) {
                                return '<div class="dropstart font-sans-serif position-static d-inline-block">
                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown0">
                                                <a class="dropdown-item btnMostrar" codigo="'.$row->id_asignacion.'" href="#!"> <i class="bi bi-card-heading"></i> Mostrar</a>
                                                <a class="dropdown-item btnActualizar" href="#!" codigo="'.$row->id_asignacion.'"> <i class="bi bi-pencil-square"></i> Actualizar</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item btnEliminar" href="#!" codigo="'.$row->id_asignacion.'"> <i class="bi bi-trash"></i> Eliminar</a>
                                            </div>
                                        </div>';
                            })->make(true);
    }
    

    public function cambiarEstadoVehiculoEmpleado($id_asignacion, Request $request) {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";
    
        try {
            // ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;
    
            // Obtener el registro de asignacion_vehiculos
            $vehiculoEmpleado = vehiculoEmpleado::where('IdAsignacion', $id_asignacion)->first();
    
            // Verificar si se encontró el registro
            if ($vehiculoEmpleado) {
                // Cambiar el estado del registro
                $vehiculoEmpleado->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
    
                // Guardar los cambios
                $vehiculoEmpleado->save();
            } else {
                $return->message = "Registro no encontrado";
                $return->code = 404;
            }
    
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }
    
        return response()->json($return, $return->code);
    }
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehiculoEmpleado $vehiculoEmpleado)
    {
        //
    }
}
