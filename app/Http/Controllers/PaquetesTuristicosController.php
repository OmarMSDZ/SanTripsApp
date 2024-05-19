<?php

// namespace App\Http\Controllers;

// use App\Models\Paquetes_turisticos;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;

// class PaquetesTuristicosController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //
//         $paquetes_turisticos = Paquetes_turisticos::select(
//             'paquetes_turisticos.idPaquete as IdPaquete',
//             'paquetes_turisticos.Nombre as Nombre',
//             'paquetes_turisticos.Descripcion as Descripcion',
//             'paquetes_turisticos.Costo as Costo',
//             'paquetes_turisticos.Num_personas as Numpersonas',
//             'paquetes_turisticos.Edades as Edades',
//             'paquetes_turisticos.Idiomas as Idiomas',
//             'paquetes_turisticos.Alojamiento as Alojamiento',
//             'paquetes_turisticos.Tiempo_estimado as Tiempo_estimado',
//             'paquetes_turisticos.Disponibilidad as Disponibilidad',
//             'categorias_paquetes.CategoriaPaq as Categoria',
//             'ofertas.Descripcion as Descoferta'
//         )
//         ->join('categorias_paquetes', 'paquetes_turisticos.fk_IdCategoriaPaq', '=', 'categorias_paquetes.IdCategoriaPaq')
//         ->join('ofertas', 'paquetes_turisticos.fk_IdOferta', '=', 'ofertas.IdOferta')
//         ->paginate(5);


//         return view('admin.adminpaquetes.adminpaquetes', compact('paquetes_turisticos'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//         return view('admin.adminpaquetes.adminpaquetes_form');
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //

//         $validatedData = $request->validate([
//             'Nombre' => 'required',
//             'Descripcion' => 'required',
//             'Costo' => 'required',
//             'Num_personas' => 'required',
//             'Edades' => 'required',
//             'Idiomas' => 'required',
//             'Alojamiento' => 'required',
//             'Tiempo_estimado' => 'required',
//             'Disponibilidad' => 'required',
//             'Categoria' => 'required',
//             'Ofertas' => 'required'
            
            
            
//         ]);
         
       

//        Paquetes_turisticos::create($request->only('Nombre','Descripcion', 'Costo','Num_personas', 'Edades','Idiomas','Alojamiento','Tiempo_estimado','Disponibilidad','Categoria','Ofertas') + [
//             'fk_IdCategoriapaq' => $request->input('Categoria'),
//             'fk_IdOferta' => $request->input('Ofertas') 
//         ]);


//         // Session::flash('mensaje', 'Registro Creado Con Exito!');
//         return redirect()->route('Paquetes.index')->with('success', 'Reserva creada correctamente.');


//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(Paquetes_turisticos $paquetes_turisticos)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Paquetes_turisticos $paquetes_turisticos)
//     {
//         //
//         return view('admin.adminpaquetes.adminpaquetes_form', compact('paquetes_turisticos'));

//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Paquetes_turisticos $paquetes_turisticos)
//     {
//         //
//         $validatedData = $request->validate([
//             'Nombre' => 'required',
//             'Descripcion' => 'required',
//             'Costo' => 'required',
//             'Num_personas' => 'required',
//             'Edades' => 'required',
//             'Idiomas' => 'required',
//             'Alojamiento' => 'required',
//             'Tiempo_estimado' => 'required',
//             'Disponibilidad' => 'required',
//             'Categoria' => 'required',
//             'Ofertas' => 'required'
            
            
            
//         ]);

//         $paquetes_turisticos->update($request->only('Nombre','Descripcion', 'Costo','Numero_personas', 'Edades','Idiomas','Alojamiento','Tiempo_estimado','Diponibilidad','Categoria','Ofertas') + [
//             'fk_IdCategoriapaq' => $request->input('Categoria'),
//             'fk_IdOferta' => $request->input('Ofertas') 
//         ]);

//         Session::flash('mensaje', 'Registro Actualizado Con Exito!');
//         return redirect()->route('Paquetes.index');

//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Paquetes_turisticos $paquetes_turisticos)
//     {
//         //

//         $paquetes_turisticos->delete();
//         Session::flash('mensaje', 'Registro Eliminado Con Exito!');
//         return redirect()->route('Paquetes.index');


//     }


//     <?php

namespace App\Http\Controllers;

use App\Models\Paquetes_turisticos;
use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class PaquetesTuristicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         

         $categoriapaq = DB::select("SELECT id, nombre FROM tipos WHERE tipo='paquetes' ");
         $ofertas = DB::select("SELECT IdOferta, Descripcion FROM ofertas");
        
        // return view('admin.adminempleados', compact('cargos_empleado'));

        return view('admin.adminpaquetes', compact('categoriapaq', 'ofertas'));

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
            // $usuario_id = Auth::user()->id;

            $paquete = new Paquetes_turisticos();
            $paquete->Nombre = $request->nombre;
            $paquete->Descripcion = $request->descripcion;
            $paquete->Costo = $request->costo;
            $paquete->Num_personas = $request->numpersonas;
            $paquete->Edades = $request->edades;
            $paquete->Idiomas = $request->idiomas;
            $paquete->Alojamiento = $request->alojamiento;
            $paquete->Tiempo_estimado = $request->tiempoestimado;
            $paquete->Disponibilidad = $request->disponibilidad;
            $paquete->Estado = $request->estado;
            
            $paquete->fk_IdCategoriapaq = isset($request->categoriapaq) ? $request->categoriapaq : null;
            $paquete->fk_IdOferta = isset($request->oferta) ? $request->oferta : null;
            
            $paquete->save();


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

     public function update($id_paquete, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            // return $request;
            //ID DEL USUARIO LOGUEADO
            // $usuario_id = Auth::user()->id;

            $paquete = Paquetes_turisticos::where('id', $id_paquete)->first();

            $paquete->Nombre = $request->nombre;
            $paquete->Descripcion = $request->descripcion;
            $paquete->Costo = $request->costo;
            $paquete->Num_personas = $request->numpersonas;
            $paquete->Edades = $request->edades;
            $paquete->Idiomas = $request->idiomas;
            $paquete->Alojamiento = $request->alojamiento;
            $paquete->Tiempo_estimado = $request->tiempoestimado;
            $paquete->Disponibilidad = $request->disponibilidad;
            $paquete->Estado = $request->estado;
            
            $paquete->fk_IdCategoriapaq = isset($request->categoriapaq) ? $request->categoriapaq : null;
            $paquete->fk_IdOferta = isset($request->oferta) ? $request->oferta : null;
            // $empleado->creado_por = $usuario_id;
            $paquete->save();


        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }

    public function getPaquete($id_paquete, Request $request) {

        $data = Paquetes_turisticos::select(
                                'id',
                                'Nombre AS nombre',
                                'Descripcion AS descripcion',
                                'Costo AS costo',
                                'Num_personas AS numpersonas',
                                'Edades AS edades',
                                'Idiomas AS idiomas',
                                'Alojamiento AS alojamiento',
                                'Tiempo_estimado AS tiempoestimado',
                                'Disponibilidad AS disponibilidad',
                                'Estado AS estado',
                                'fk_IdCategoriapaq AS categoriapaq',
                                'fk_IdOferta AS oferta',
                                
                            )
                            ->where('id', $id_paquete)->first();
                            
        return response()->json($data);
    }

    public function getPaquetes(Request $request) {

        $data = Paquetes_turisticos::
                    select(
                        'id',
                        'Nombre AS nombre',
                        'Descripcion AS descripcion',
                        'Costo AS costo',
                        'Num_personas AS numpersonas',
                        'Edades AS edades',
                        'Idiomas AS idiomas',
                        'Alojamiento AS alojamiento',
                        'Tiempo_estimado AS tiempoestimado',
                        'Disponibilidad AS disponibilidad',
                        'Estado AS estado',
                        'fk_IdCategoriapaq AS categoriapaq',
                        'fk_IdOferta AS oferta',
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
                                                    <a class="dropdown-item text-danger btnEliminar" href="#!" codigo="'.$row->id.'"> <i class="bi bi-trash"></i> Eliminar</a>
                                                    <div class="dropdown-divider"></div>
                                                    '. $btnActivo .'
                                            </div>
                                        </div>';
                            })->addColumn('estado', function ($row) {
                                return $row->estado == 'ACTIVO' ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
                            })->rawColumns(['action', 'estado'])->make(true);
    }

    
    public function cambiarPaquete($id_paquete, Request $request) {

        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {

            //ID DEL USUARIO LOGUEADO
            // $usuario_id = Auth::user()->id;

            $paquete = Paquetes_turisticos::where('id', $id_paquete)->first();
            $paquete->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            // $empleados->actualizado_por = $usuario_id;
            $paquete->save();

        } catch (\Throwable $th) {
            // throw $th->getMessage();
            $return->message = $th->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }


    public function destroy($id_paquete)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Registro eliminado correctamente";
    
        try {
            $paquete = Paquetes_turisticos::findOrFail($id_paquete);
            $paquete->delete();
        } catch (\Exception $e) {
            $return->message = $e->getMessage();
            $return->code = 500;
        }
        return response()->json($return, $return->code);
    }


}



