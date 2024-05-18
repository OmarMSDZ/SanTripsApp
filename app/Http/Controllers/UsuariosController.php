<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $cargos_empleado = Cargos_empleado::select('IdCargo', 'Cargo')->get();

        // $cargos_empleado = DB::select('Select IdCargo, Cargo from cargos_empleado');
        
        return view('admin.adminusuarios');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource. NO SE VA A MANEJAR YA QUE SE REGISTRARAN POR OTRA PARTE LOS USUARIOS
     */

     public function store(Request $request) {

        // $return = new stdClass();
        // $return->code = 200;
        // $return->message = "Se ha guardado de forma correcta";

        // try {

        //     // return $request;
        //     //ID DEL USUARIO LOGUEADO
        //     // $usuario_id = Auth::user()->id;

        //     // $request->validate([
        //     //     'nombre_destino' => 'required',
        //     //     'provincia' => 'required',
        //     //     'abierto_hasta' => 'required',
        //     //     'abierto_desde' => 'required',
        //     // ]);

        //     $usuario = new User();
        //     $usuario->nombres = $request->nombres;
        //     $usuario->apellidos = $request->apellidos;
        //     $usuario->telefono = $request->telefono;
        //     $usuario->name = $request->usuario;
        //     $usuario->email = $request->email;
        //     // $usuario->password = $request->password;
        //     $usuario->usertype = $request->tipousuario;
        //     $usuario->estado = isset($request->estado) ? $request->estado : null;
             
        //     $usuario->save();


        // } catch (\Throwable $th) {
        //     // throw $th->getMessage();
        //     $return->message = $th->getMessage();
        //     $return->code = 500;
        // }
        // return response()->json($return, $return->code);
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

     public function update($id_usuario, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            // return $request;
 

            $usuario = User::where('id', $id_usuario)->first();
            $usuario->nombres = $request->nombres;
            $usuario->apellidos = $request->apellidos;
            $usuario->telefono = $request->telefono;
            $usuario->name = $request->usuario;
            $usuario->email = $request->email;
            // $usuario->password = $request->password;
            $usuario->usertype = $request->tipousuario;
            $usuario->estado = isset($request->estado) ? $request->estado : null;
             
            $usuario->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function getUsuario($id_usuario, Request $request) {

        $data = User::select(
                                'id',
                                'nombres AS nombres',
                                'apellidos AS apellidos',
                                'telefono AS telefono',
                                'name AS name',
                                'email AS email',  
                                'usertype AS usertype',
                                'Estado AS estado',
                            )
                            ->where('id', $id_usuario)->first();


        

        return response()->json($data);
    }

    public function getUsuarios(Request $request) {

        $data = User::select(
            'id',
            'nombres AS nombres',
            'apellidos AS apellidos',
            'telefono AS telefono',
            'name AS name',
            'email AS email',  
            'usertype AS usertype',
              
            'Estado AS estado',
        )->get();

        return datatables()->of($data)
                            ->addColumn('action', function($row) {

                                $btnActivo = $row->estado == 'ACTIVO' ? "<a class='dropdown-item text-danger btnCambiarEstado' estado='$row->estado' nombre='$row->nombres' href='#!' codigo='$row->id'> <i class='bi bi-x'> </i> Desactivar</a>" : "<a class='dropdown-item text-success btnCambiarEstado' href='#!' estado='$row->estado' nombre='$row->nombres'  codigo='$row->id'> <i class='bi bi-check2'> </i> Activar</a>";

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

    
    public function cambiarUsuario($id_usuario, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

          
            $usuario = User::where('id', $id_usuario)->first();
            $usuario->estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
 
            $usuario->save();

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

}
