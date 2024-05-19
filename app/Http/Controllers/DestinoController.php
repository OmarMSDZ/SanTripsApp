<?php

namespace App\Http\Controllers;

use App\Models\Destinos;
use App\Models\Proveedor;
use App\Models\Tipo;
use App\Services\CountryStateCityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class DestinoController extends Controller
{
    public function index() {

        $tipos_destinos = Tipo::select('id', 'nombre')
                            ->where('tipo', 'destinos')
                            ->where('activo', 1)
                            ->get();

        // return $tipos_destinos;
        $obj_country = new CountryStateCityService();
        $provincias = $obj_country->getCountry();
        $provincias = $obj_country->getStates();

        $proveedores = Proveedor::select('id', 'nombre', 'telefono')->where('estado', 'ACTIVO')->get();

        return view('admin.admindestinos', compact('tipos_destinos', 'provincias', 'proveedores'));
    }

    public function store(Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha guardado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;

            $request->validate([
                'nombre_destino' => 'required',
                'provincia' => 'required',
                'abierto_hasta' => 'required',
                'abierto_desde' => 'required',
            ]);

            $destinos = new Destinos();
            $destinos->id_tipo_destino = $request->tipo_destino;
            $destinos->id_proveedor = $request->empresa;
            $destinos->nombre = $request->nombre_destino;
            $destinos->hora_desde = $request->abierto_desde;
            $destinos->hora_hasta = $request->abierto_hasta;
            $destinos->observaciones = $request->observaciones;
            $destinos->id_pais = isset($request->pais) ? $request->pais : null;
            $destinos->id_provincia = isset($request->provincia) ? $request->provincia : null;
            $destinos->creado_por = $usuario_id;
            $destinos->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function update($id_destino, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;

            $request->validate([
                'nombre_destino' => 'required',
                'provincia' => 'required',
                'abierto_hasta' => 'required',
                'abierto_desde' => 'required',
            ]);

            $destinos = Destinos::where('id', $id_destino)->first();
            $destinos->id_tipo_destino = $request->tipo_destino;
            $destinos->id_proveedor = $request->empresa;
            $destinos->nombre = $request->nombre_destino;
            $destinos->hora_desde = $request->abierto_desde;
            $destinos->hora_hasta = $request->abierto_hasta;
            $destinos->observaciones = $request->observaciones;
            $destinos->id_pais = isset($request->pais) ? $request->pais : null;
            $destinos->id_provincia = isset($request->provincia) ? $request->provincia : null;
            $destinos->actualizado_por = $usuario_id;
            $destinos->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function cambiarDestino($id_destino, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;

            $destinos = Destinos::where('id', $id_destino)->first();
            $destinos->activo = $request->estado == 1 ? 0 : 1;
            $destinos->actualizado_por = $usuario_id;
            $destinos->save();

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function getDestino($id_destino, Request $request) {

        $data = Destinos::select(
                                'id',
                                'id_tipo_destino',
                                'id_proveedor',
                                'nombre',
                                'hora_desde',
                                'hora_hasta',
                                'observaciones',
                                'id_pais',
                                'id_provincia',
                                'id_ciudad',
                                'activo',
                            )
                            ->where('id', $id_destino)->first();

        return response()->json($data);
    }

    public function getDestinos(Request $request) {

        $data = DB::table('destinos AS d')
                    ->select(
                        'd.id',
                        'd.nombre',
                        'd.hora_desde',
                        'd.hora_hasta',
                        'd.observaciones',
                        'prv.nombre AS proveedor',
                        'prv.telefono',
                        'prv.email',
                        'p.nombre AS provincia',
                        'c.nombre AS ciudad',
                        'u.name AS creado_por',
                        'd.activo'
                    )
                    ->join('tipos AS tp', 'tp.id', '=', 'd.id_tipo_destino')
                    ->join('proveedores AS prv', 'prv.id', '=', 'd.id_proveedor')
                    ->join('users AS u', 'u.id', '=', 'd.creado_por')
                    ->leftJoin('provincias AS p', 'p.id', '=', 'd.id_provincia')
                    ->leftJoin('ciudades AS c', 'c.id', '=', 'd.id_ciudad')
                    ->get();

        return datatables()->of($data)
                            ->addColumn('action', function($row) {
                                $btnActivo = $row->activo == 1 ? "<a class='dropdown-item text-danger btnCambiarEstado' estado='$row->activo' href='#!' codigo='$row->id'> <i class='bi bi-x'> </i> Desactivar</a>" : "<a class='dropdown-item text-success btnCambiarEstado' href='#!' estado='$row->activo' codigo='$row->id'> <i class='bi bi-check2'> </i> Activar</a>";
                            
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
                                return $row->activo == 1 ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
                            })->rawColumns(['action', 'estado'])->make(true);
    }


    public function destroy($id_destino)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Registro eliminado correctamente";
    
        try {
            $destino = Destinos::findOrFail($id_destino);
            $destino->delete();
        } catch (\Exception $e) {
            $return->message = $e->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }
    
    


}
