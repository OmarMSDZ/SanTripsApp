<?php

namespace App\Http\Controllers;

use App\Models\Cargos_empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class CargosEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    //$cargos_empleado = CargoEmpleado::all();
    // Variables a utilizar en el form de admin
    $cargos_empleado = DB::select('SELECT IdCargo, Cargo, Sueldo, Responsabilidades FROM cargos_empleado');
    
    return view('admin.admincargoempleado', compact('cargos_empleado'));
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
            
            $cargos_empleado = new Cargos_empleado();
            $cargos_empleado->Cargo = $request->cargo;
            $cargos_empleado->Sueldo = $request->sueldo;
            $cargos_empleado->Responsabilidades = $request->responsabilidades;
            
            $cargos_empleado->save();
    
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cargos_empleado $cargos_empleado)
{
    //return view('admin.editarcargo', compact('cargo_empleado'));
}


    /**
     * Update the specified resource in storage.
     */

     public function update($idCargo, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";
    
        try {
    
            $cargos_empleado = Cargos_empleado::find($idCargo);
            $cargos_empleado->Cargo = $request->cargo;
            $cargos_empleado->Sueldo = $request->sueldo;
            $cargos_empleado->Responsabilidades = $request->responsabilidades;
            
            $cargos_empleado->save();
    
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }
    
    public function getCargoempleado( $idCargo, Request $request) {

        $data = Cargos_empleado::select(
                                'IdCargo',
                                'Cargo AS cargo',
                                'Sueldo AS sueldo',
                                'Responsabilidades AS responsabilidades',
                            )
                            ->where('IdCargo',  $idCargo)->first();
    
        return response()->json($data);
    }
    

    public function getCargoempleados(Request $request) {

        $data = Cargos_empleado::select(
                'IdCargo AS id',
                'Cargo AS cargo',
                'Sueldo AS sueldo',
                'Responsabilidades AS responsabilidades',
                'Estado AS estado'
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
                                                    <a class="dropdown-item text-danger btnEliminar" href="#!" codigo="'.$row->id.'"> <i class="bi bi-trash"></i> Eliminar</a>
                                                    <div class="dropdown-divider"></div>
                                                    '. $btnActivo .'
                                            </div>
                                        </div>';
                            })->addColumn('estado', function ($row) {
                                return $row->estado == 'ACTIVO' ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
                            })->rawColumns(['action', 'estado'])->make(true);
    }

    
    public function cambiarCargoempleado($idCargo, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";
    
        try {
    
            $cargos_empleado = Cargos_empleado::find($idCargo);
            $cargos_empleado->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            $cargos_empleado->save();
    
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }
    

    public function delete($idCargo)
{
    $return = new stdClass();
    $return->code = 200;
    $return->message = "Registro eliminado correctamente";

    try {
        $cargos_empleado = Cargos_empleado::findOrFail($idCargo);
        $cargos_empleado->delete();
    } catch (\Exception $e) {
        $return->message = $e->getMessage();
        $return->code = 500;
    }
    return response()->json($return, $return->code);
}

    


}
