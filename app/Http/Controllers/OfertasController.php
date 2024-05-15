<?php

namespace App\Http\Controllers;

use App\Models\Ofertas;
use App\Models\Tipo;
// use App\Services\CountryStateCityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class OfertasController extends Controller
{
    public function index() {

        //para retornar esta vista
        return view('admin.adminofertas');
    
    }

    public function store(Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha guardado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            // $usuario_id = Auth::user()->id;

        

            $ofertas = new Ofertas();
          
            $ofertas->Descripcion = $request->descripcion_oferta;
            $ofertas->Porcentaje = $request->porcentaje_oferta;
            $ofertas->FechaDesde = $request->fecha_desde;
            $ofertas->FechaHasta = $request->fecha_hasta;

            $ofertas->Estado = $request->estado;

            // $ofertas->creado_por = $usuario_id;
            $ofertas->save();

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function update($id_oferta, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            // $usuario_id = Auth::user()->id;

            // $request->validate([
            //     'nombre_destino' => 'required',
            //     'provincia' => 'required',
            //     'abierto_hasta' => 'required',
            //     'abierto_desde' => 'required',
            // ]);

            $ofertas = Ofertas::where('id', $id_oferta)->first();
            
            $ofertas->descripcion = $request->descripcion;
            $ofertas->porcentaje = $request->porcentaje;
            $ofertas->fechadesde = $request->fechadesde;
            $ofertas->fechahasta = $request->fechahasta;
            
            $ofertas->Estado = $request->estado;
            
            // $ofertas->actualizado_por = $usuario_id;
            $ofertas->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    // Esto sirve para cambiar el estado (activo o inactivo)
    public function cambiarPaquete($id_oferta, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            // $usuario_id = Auth::user()->id;

            $oferta = Ofertas::where('id', $id_oferta)->first();
            $oferta->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            // $empleados->actualizado_por = $usuario_id;
            $oferta->save();

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    //esto para obtener un registro especifico
    public function getOferta($id_oferta, Request $request) {

        $data = Ofertas::select(
                                'IdOferta',
                                'Descripcion',
                                'Porcentaje',
                                'FechaDesde',
                                'FechaHasta',
                                'Estado',
                                
                               
                            )
                            ->where('IdOferta', $id_oferta)->first();

        return response()->json($data);
    }

    //esto para obtener varios registros y listarlos en la tabla de consulta
    public function getOfertas(Request $request) {

        $data = Ofertas::select(
                        'IdOferta as id',
                        'Descripcion as descripcion',
                        'Porcentaje as porcentaje',
                        'FechaDesde as fechadesde',
                        'FechaHasta as fechahasta',
                        'created_at AS creado_en',
                        'Estado as estado'
                     
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
                                    <div class="dropdown-divider"></div>
                                    '. $btnActivo .'
                            </div>
                        </div>';
            })->addColumn('estado', function ($row) {
                return $row->estado == 'ACTIVO' ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
            })->rawColumns(['action', 'estado'])->make(true);
    }


}
