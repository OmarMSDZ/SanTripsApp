<?php

namespace App\Http\Controllers;

 
use App\Models\Proveedor;
use App\Models\Tipo; 

use App\Services\CountryStateCityService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
        //se toma de la tabla tipo
        $tipos_servicio = Tipo::select('id', 'nombre')
                            ->where('tipo', 'proveedores')
                            ->where('activo', 1)
                            ->get();

     
        $obj_country = new CountryStateCityService();
        $provincias = $obj_country->getCountry();
        $provincias = $obj_country->getStates();
        
        
         return view('admin.adminempresasproveedoras', compact('tipos_servicio', 'provincias'));

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

            $proveedor = new Proveedor();

            $proveedor->nombre= $request->nombre;
            $proveedor->telefono = $request->telefono;
            $proveedor->email = $request->email;
            $proveedor->id_tipo_servicio = $request->tiposervicio;
            // $proveedor->id_pais = $request->pais;
            $proveedor->id_provincia = isset($request->provincia) ? $request->provincia : null;
            $proveedor->direccion = isset($request->direccion) ? $request->direccion : null;
            $proveedor->estado = isset($request->estado) ? $request->estado : null;
            $proveedor->creado_por = $usuario_id;

            $proveedor->save();


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
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function update($id_proveedor, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            // return $request;
               //ID DEL USUARIO LOGUEADO
           $usuario_id = Auth::user()->id;

            $proveedor = Proveedor::where('id', $id_proveedor)->first();
            $proveedor->nombre= $request->nombre;
            $proveedor->telefono = $request->telefono;
            $proveedor->email = $request->email;
            $proveedor->id_tipo_servicio = $request->tiposervicio;
            // $proveedor->id_pais = $request->pais;
            $proveedor->id_provincia = $request->provincia;
            $proveedor->direccion = $request->direccion;
            $proveedor->estado = isset($request->estado) ? $request->estado : null;
            $proveedor->actualizado_por = $usuario_id;
            $proveedor->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function getProveedor($id_proveedor, Request $request) {

        $data = Proveedor::select(
                                'id',
                                'nombre',
                                'telefono',
                                'email',
                                'id_tipo_servicio AS tipo',
                                // 'id_pais AS pais',
                                'id_provincia AS provincia',
                                'direccion',
                                'estado',
                            )
                            ->where('id', $id_proveedor)->first();


        

        return response()->json($data);
    }

    public function getProveedores(Request $request) {

        $data = DB::table('proveedores AS p')
        ->select(
            'p.id',
            'p.nombre as nombre',
            'p.telefono as telefono',
            'p.email as email',
    
            // tipo de servicio
            'tip.nombre as nombretiposervicio',
            // otros campos fk
            // 'pais.nombre AS pais',
            'prov.nombre AS provincia',
            'u.name AS creado_por',
    
            'p.direccion as direccion',
            'p.estado as estado'
        )
        ->join('tipos AS tip', 'tip.id', '=', 'p.id_tipo_servicio')
        // ->join('paises AS pais', 'pais.id', '=', 'p.id_pais')
        ->leftJoin('provincias AS prov', 'prov.id', '=', 'p.id_provincia')
        ->join('users AS u', 'u.id', '=', 'p.creado_por') // Aquí se cambió 'd.creado_por' a 'p.creado_por'
        ->get();

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
                                                    <a class="dropdown-item text-danger btnEliminar" href="#!" codigo="'.$row->id.'"> <i class="bi bi-trash"></i> Eliminar</a>
                                                    <div class="dropdown-divider"></div>
                                                    '. $btnActivo .'
                                            </div>
                                        </div>';
                            })->addColumn('estado', function ($row) {
                                return $row->estado == 'ACTIVO' ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
                            })->rawColumns(['action', 'estado'])->make(true);
    }

    
    public function cambiarProveedor($id_proveedor, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            $usuario_id = Auth::user()->id;

            $proveedor = Proveedor::where('id', $id_proveedor)->first();
            $proveedor->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            // $empleados->actualizado_por = $usuario_id;
            $proveedor->save();

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    
    public function destroy($id_proveedor)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Registro eliminado correctamente";
    
        try {
            $proveedor = Proveedor::findOrFail($id_proveedor);
            $proveedor->delete();
        } catch (\Exception $e) {
            $return->message = $e->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    
}
