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

     public function update($id_empleado, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizar de forma correcta";

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

            // return $id_empleado;

            $empleado = Empleados::whereRaw('IdEmpleado  = ? ', [$id_empleado])->first();
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

    public function getEmpleado($id_empleado, Request $request) {

        $data = Empleados::select(
                                'IdEmpleado AS id',
                                'Cedula AS cedula',
                                'Nombres AS nombre',
                                'Apellidos AS apellido',
                                'Telefono AS telefono',
                                'Email AS email',
                                'Fecha_ingreso AS fecha_ingreso',
                                'Fecha_salida AS fecha_salida',
                                'LicenciaConducir AS licencia_conducir',
                                'Estado AS estado',
                            )
                            ->where('IdEmpleado', $id_empleado)->first();

        return response()->json($data);
    }

    public function getEmpleados(Request $request) {

        $data = Empleados::
                    select(
                        'IdEmpleado AS id',
                        'Cedula AS cedula',
                        'Nombres AS nombre',
                        'Apellidos AS apellido',
                        'Telefono AS telefono',
                        'Email AS email',
                        'Fecha_ingreso AS fecha_ingreso',
                        'Fecha_salida AS fecha_salida',
                        'LicenciaConducir AS licencia_conducir',
                        'Estado AS estado',
                    )->get();

        return datatables()->of($data)
                            ->addColumn('action', function($row) {

                                $btnActivo = $row->estado == 'ACTIVO' ? "<a class='dropdown-item text-danger btnCambiarEstado' estado='$row->activo' href='#!' codigo='$row->id'> <i class='bi bi-x'> </i> Desactivar</a>" : "<a class='dropdown-item text-success btnCambiarEstado' href='#!' estado='$row->activo' codigo='$row->id'> <i class='bi bi-check2'> </i> Activar</a>";

                                return '<div class="dropstart font-sans-serif position-static d-inline-block">
                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown0">
                                                    <a class="dropdown-item btnMostrar" codigo="'.$row->id.'" href="#!"> <i class="bi bi-card-heading"></i> Mostrar</a>
                                                    <a class="dropdown-item btnActualizar" href="#!" codigo="'.$row->id.'"> <i class="bi bi-pencil-square"></i> Actualizar</a>
                                                    <div class="dropdown-divider"></div>
                                                    '. $btnActivo .'
                                            </div>
                                        </div>';
                            })->addColumn('estado', function ($row) {
                                return $row->activo == 1 ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
                            })->rawColumns(['action', 'estado'])->make(true);
    }
}
