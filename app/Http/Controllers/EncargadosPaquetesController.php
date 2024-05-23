<?php

namespace App\Http\Controllers;

use App\Models\Encargados_paquetes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;


class EncargadosPaquetesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // id paquetes turisticos

  $id_paquete_turistico = DB::select('Select id, Nombre from paquetes_turisticos');

        
  // id empleado 
       $id_empleado = DB::select('Select id, Nombres from empleados');
          
       return view('admin.adminencargadopaq', compact('id_paquete_turistico','id_empleado'));
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
           

            $encargadopaq = new Encargados_paquetes();
            $encargadopaq->Fecha = $request->Fecha;
            $encargadopaq->id_paquete_turistico = $request->id_paquete_turistico;
            $encargadopaq->id_empleado = $request->id_empleado;


              $encargadopaq->save();

            


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
    public function show(Encargados_paquetes $encargados_paquetes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Encargados_paquetes $encargados_paquetes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";
    
        try {
            // Obtener el registro usando el ID pasado como parámetro
            $encargadopaq = Encargados_paquetes::where('IdEncargadosPaquetes', $id)->first();
            if (!$encargadopaq) {
                throw new \Exception("Registro no encontrado");
            }
    
            // Actualizar los campos
            $encargadopaq->Fecha = $request->Fecha;
            $encargadopaq->id_paquete_turistico = $request->id_paquete_turistico;
            $encargadopaq->id_empleado = $request->id_empleado;
            $encargadopaq->save();
    
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function getEncargadopaquete($id, Request $request) {

        $data = Encargados_paquetes::select(
                                'IdEncargadosPaquetes AS id',
                                'Fecha AS Fecha',
                                'id_paquete_turistico AS id_paquete_turistico',
                                'id_empleado AS id_empleado',
                            )
                            ->where('IdEncargadosPaquetes', $id)->first();
        return response()->json($data);
    }

    public function getEncargadospaquetes(Request $request) {

        // $data = Encargados_paquetes::
        //             select(
        //                 'id',
        //                 'Fecha AS Fecha',
        //                 'id_paquetes_turistico AS id_paquetes_turistico',
        //                 'id_empleado AS id_empleado',


                        
        //             )->get();


        $data=DB::select("SELECT 
	                ep.IdEncargadosPaquetes as id,
	                ep.Fecha,
                    ep.id_paquete_turistico,
	                pt.Nombre AS paquete_turistico,
	                emp.id AS id_empleado,
                    emp.Nombres
                    FROM encargados_paquetes AS ep
                    INNER JOIN paquetes_turisticos AS pt ON pt.id = ep.id_paquete_turistico
                    INNER JOIN empleados AS emp ON emp.id = ep.id_empleado

                    ");

        return datatables()->of($data)
                            ->addColumn('action', function($row) {

                              

                                return '<div class="dropstart font-sans-serif position-static d-inline-block">
                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown0">
                                                    <a class="dropdown-item btnMostrar" codigo="'.$row->id.'" href="#!"> <i class="bi bi-card-heading"></i> Mostrar</a>
                                                    <a class="dropdown-item btnActualizar" href="#!" codigo="'.$row->id.'" fecha="'. $row->Fecha .'" paquete_turistico="'. $row->id_paquete_turistico .'" Empleado="'. $row->id_empleado .'"> <i class="bi bi-pencil-square"></i> Actualizar</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger btnBorrarRegistro" href="#!" codigo="'. $row->id .'"> <i class="bi bi-x"> </i> Borrar</a>
                                                    
                                            </div>
                                        </div>';
                            })->rawColumns(['action'])->make(true);
    }

    public function delete($id) {

        $return = new stdClass();
        $return->msg = "Se ha eliminado de forma exitosa!";
        $return->code = 200;

        try {
            $registro = Encargados_paquetes::where('IdEncargadosPaquetes', $id)->delete();

        } catch (\Throwable $th) {
            //throw $th;
            $return->code = 500;
            $return->msg = $th->getMessage();
        }

        return response()->json($return);

    }
    
    public function cambiarencargado($id, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            // $usuario_id = Auth::user()->id;

            $encargadopaq = Encargados_paquetes::where('', $id)->first();



            // $empleados->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            // $empleados->actualizado_por = $usuario_id;
            $encargadopaq->save();

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Encargados_paquetes $encargados_paquetes)
    {
        
    }
}
