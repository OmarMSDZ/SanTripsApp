<?php

namespace App\Http\Controllers;

// use App\Models\Cargos_empleado; modelo de id paqute 
// use App\Models\Cargos_empleado; modelo de destino
use App\Models\Paquetes_destinos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;


class PaquetesDestinosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // id paquetes turisticos

  $id_paquetes_turistico = DB::select('Select id, Nombre from paquetes_turisticos');
        
// id destino

     $id_destino = DB::select('Select id, nombre from destinos');
        
     return view('admin.adminpaqdestino', compact('id_paquetes_turistico','id_destino'));
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
           

            $paqdestino = new Paquetes_destinos();
            $paqdestino->id_paquetes_turistico = $request->paquete_turistico;
            $paqdestino->id_destino = $request->destino;


            //id del paquete tursitico
            // $paqdestino->id_paquetes_turistico  = isset($request->id_paquetes_turisticos ) ? $request->id_paquetes_turisticos : null;
            // // $empleado->creado_por = $usuario_id; 
            // $id_paquetes_turisticos ->save();


              //id del destino
            //   $paqdestino->id_destino  = isset($request->id_destino ) ? $request->id_destino : null;
              // $empleado->creado_por = $usuario_id; 
              $paqdestino->save();

            


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
    public function show(Paquetes_destinos $paquetes_destinos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paquetes_destinos $paquetes_destinos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paquetes_destinos $paquetes_destinos)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizar de forma correcta";

        try {
            // return $request;
             $codigo = $request->codigo;

            $paqdestino = Paquetes_destinos::where('id', $codigo)->first();
            $paqdestino->id_paquetes_turistico = $request->paquete_turistico;
            $paqdestino->id_destino  = $request->destino;

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function getPaquetedestino($id, Request $request) {

        $data = Paquetes_destinos::select(
                                'id',
                                'id_paquetes_turistico AS id_paquetes_turisticos',
                                'id_destino AS id_destino',
                            )
                            ->where('id', $id)->first();


        

        return response()->json($data);
    }

    public function getPaquetesdestinos(Request $request) {

        // $data = Paquetes_destinos::
        //             select(
        //                 'id',
        //                 'id_paquetes_turistico AS id_paquetes_turistico',
        //                 'id_destino AS id_destino',
        //             )->get();

        $data = DB::select("SELECT 
                            pd.id,
                            pt.id AS id_paquete_turistico,
                            pt.Nombre AS paquete_turistico,
                            pt.Descripcion AS descripcion,
                            pt.Costo,
                            pt.Edades AS edades,
                            pt.Idiomas AS idiomas,
                            d.id AS id_destino,
                            d.nombre AS destino,
                            d.hora_hasta,
                            d.hora_desde,
                            pt.Estado AS estado
                        FROM paquetes_destinos AS pd 
                        INNER JOIN paquetes_turisticos AS pt ON pt.id = pd.id_paquetes_turistico
                        INNER JOIN destinos AS d ON d.id = pd.id_destino
                    ");

        // return $data;
        return datatables()->of($data)
                            ->addColumn('action', function($row) {


                                return '<div class="dropstart font-sans-serif position-static d-inline-block">
                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown0">
                                                    <a class="dropdown-item btnMostrar" codigo="'.$row->id.'" href="#!"> <i class="bi bi-card-heading"></i> Mostrar</a>
                                                    <a class="dropdown-item btnActualizar" href="#!" codigo="'.$row->id.'" destino="'. $row->id_destino .'" paquete_turistico="'. $row->id_paquete_turistico .'"> <i class="bi bi-pencil-square"></i> Actualizar</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger btnBorrarRegistro" href="#!" codigo="'. $row->id .'"> <i class="bi bi-x"> </i> Borrar</a>
                                            </div>
                                        </div>';
                            })->addColumn('estado', function ($row) {
                                return $row->estado == 'activo' ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
                            })->rawColumns(['action', 'estado'])->make(true);
    }

    public function delete($id) {

        $return = new stdClass();
        $return->msg = "Se ha eliminado de forma exitosa!";
        $return->code = 200;

        try {
            $registro = Paquetes_destinos::where('id', $id)->delete();

        } catch (\Throwable $th) {
            //throw $th;
            $return->code = 500;
            $return->msg = $th->getMessage();
        }

        return response()->json($return);

    }
    
    public function cambiarPaquetesdestino($id, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;

            $paqdestino = Paquetes_destinos::where('id', $id)->first();



            // $empleados->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            // $empleados->actualizado_por = $usuario_id;
            $paqdestino->save();

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
    public function destroy(Paquetes_destinos $paquetes_destinos)
    {
        //
    }
}
