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

  $id_paquetes_turistico = DB::select('Select id, Nombre from paquetes_turisticos');
        
  // id empleado 
       $id_empleado = DB::select('Select id, Nombres from empleados');
          
       return view('admin.adminencargadopaq', compact('id_paquetes_turistico','id_empleado'));
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
            $encargadopaq->id_paquetes_turistico = $request->id_paquetes_turistico;
            $encargadopaq->id_destino = $request->id_destino;


            //id del paquete tursitico
            // $paqdestino->id_paquetes_turistico  = isset($request->id_paquetes_turisticos ) ? $request->id_paquetes_turisticos : null;
            // // $empleado->creado_por = $usuario_id; 
            // $id_paquetes_turisticos ->save();


              //id del destino
            //   $paqdestino->id_destino  = isset($request->id_destino ) ? $request->id_destino : null;
              // $empleado->creado_por = $usuario_id; 
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
    public function update(Request $request, Encargados_paquetes $encargados_paquetes)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizar de forma correcta";

        try {

            // return $request;
             
            $encargadopaq = Encargados_paquetes::where('id', $id)->first();
            $encargadopaq->Fecha = $request->Fecha;
            $encargadopaq->id_paquetes_turistico = $request->id_paquetes_turistico;
            $encargadopaq->id_destino = $request->id_destino;
           
          


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function getEncargadopaquete($id, Request $request) {

        $data = Encargados_paquetes::select(
                                'id',
                                'Fecha AS Fecha',
                                'id_paquetes_turistico AS id_paquetes_turisticos',
                                'id_destino AS id_destino',
                         
                             
                            )
                            ->where('id', $id)->first();


        

        return response()->json($data);
    }

    public function getEncargadospaquetes(Request $request) {

        $data = Encargados_paquetes::
                    select(
                        'id',
                        'Fecha AS Fecha',
                        'id_paquetes_turistico AS id_paquetes_turistico',
                        'id_destino AS id_destino',
                    )->get();

        return datatables()->of($data)
                            ->addColumn('action', function($row) {

                                $btnActivo = $row->estado == 'ACTIVO' ? "<a class='dropdown-item text-danger btnCambiarEstado' estado='$row->estado' nombre='$row->nombre' href='#!' codigo='$row->id'> <i class='bi bi-x'> </i> Desactivar</a>" : "<a class='dropdown-item text-success btnCambiarEstado' href='#!' estado='$row->estado' nombre='$row->nombre'  codigo='$row->id'> <i class='bi bi-check2'> </i> Activar</a>";

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
                                return $row->estado == 'ACTIVO' ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
                            })->rawColumns(['action', 'estado'])->make(true);
    }

    
    public function cambiarencargado($id, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;

            $encargadopaq = Encargados_paquetes::where('id', $id)->first();



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
        //
    }
}
