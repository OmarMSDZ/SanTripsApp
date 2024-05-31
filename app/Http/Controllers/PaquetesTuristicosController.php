<?php

namespace App\Http\Controllers;

use App\Models\Paquetes_turisticos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha guardado de forma correcta";

        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'costo' => 'required|numeric',
                'numpersonas' => 'required|integer',
                'edades' => 'required|string',
                'idiomas' => 'required|string',
                'alojamiento' => 'required|string',
                'tiempoestimado' => 'required|string',
                'disponibilidad' => 'required|string',

                'horainicio' => 'required',
                //este dato no se le muestra al usuario
                'puntoencuentro' => 'required',
                
                
                'estado' => 'required|string',
                'imagen1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'imagen2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'imagen3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

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
            $paquete->Horainicio = $request->horainicio;

            $paquete->PuntoEncuentro = $request->puntoencuentro;
            
            $paquete->Estado = $request->estado;
            $paquete->id_categoria_paquete = isset($request->categoriapaq) ? $request->categoriapaq : null;
            $paquete->fk_IdOferta = isset($request->oferta) ? $request->oferta : null;

            if ($request->hasFile('imagen1')) {
                $paquete->imagen1 = $request->file('imagen1')->store('paquetes_imagenes', 'public');
            }
            if ($request->hasFile('imagen2')) {
                $paquete->imagen2 = $request->file('imagen2')->store('paquetes_imagenes', 'public');
            }
            if ($request->hasFile('imagen3')) {
                $paquete->imagen3 = $request->file('imagen3')->store('paquetes_imagenes', 'public');
            }

            $paquete->save();
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }

        return response()->json($return, $return->code);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id_paquete, Request $request)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'costo' => 'required|numeric',
                'numpersonas' => 'required|integer',
                'edades' => 'required|string',
                'idiomas' => 'required|string',
                'alojamiento' => 'required|string',
                'tiempoestimado' => 'required|string',
                'disponibilidad' => 'required|string',

                'horainicio' => 'required',
                'puntoencuentro' => 'required',
                
                
                'estado' => 'required|string',
                'imagen1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'imagen2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'imagen3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

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
            $paquete->Horainicio = $request->horainicio;
            $paquete->PuntoEncuentro = $request->puntoencuentro;
            
            
            $paquete->Estado = $request->estado;
            $paquete->id_categoria_paquete = isset($request->categoriapaq) ? $request->categoriapaq : null;
            $paquete->fk_IdOferta = isset($request->oferta) ? $request->oferta : null;

            if ($request->hasFile('imagen1')) {
                // Eliminar la imagen anterior si existe
                if ($paquete->imagen1) {
                    Storage::disk('public')->delete($paquete->imagen1);
                }
                $paquete->imagen1 = $request->file('imagen1')->store('paquetes_imagenes', 'public');
            }
            if ($request->hasFile('imagen2')) {
                if ($paquete->imagen2) {
                    Storage::disk('public')->delete($paquete->imagen2);
                }
                $paquete->imagen2 = $request->file('imagen2')->store('paquetes_imagenes', 'public');
            }
            if ($request->hasFile('imagen3')) {
                if ($paquete->imagen3) {
                    Storage::disk('public')->delete($paquete->imagen3);
                }
                $paquete->imagen3 = $request->file('imagen3')->store('paquetes_imagenes', 'public');
            }

            $paquete->save();
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }

        return response()->json($return, $return->code);
    }

    /**
     * Display the specified resource.
     */
    public function getPaquete($id_paquete, Request $request)
    {
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
            'Horainicio AS horainicio',
            //este dato no se le muestra al usuario
            'PuntoEncuentro AS puntoencuentro',
            
            'Estado AS estado',
            'id_categoria_paquete AS categoriapaq',
            'fk_IdOferta AS oferta',
            'imagen1',
            'imagen2',
            'imagen3'
        )
        ->where('id', $id_paquete)->first();
                            
        return response()->json($data);
    }

    public function getPaquetes(Request $request)
    {
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
            'Horainicio AS horainicio',

            //este dato no se le muestra al usuario
            'PuntoEncuentro AS puntoencuentro',
            
            
            'Estado AS estado',
            'id_categoria_paquete AS categoriapaq',
            'fk_IdOferta AS oferta',
            'imagen1',
            'imagen2',
            'imagen3'
        )->get();

        return datatables()->of($data)
            ->addColumn('action', function($row) {
                $btnActivo = $row->estado == 'ACTIVO' 
                    ? "<a class='dropdown-item text-danger btnCambiarEstado' estado='$row->estado' nombre='$row->nombre' href='#!' codigo='$row->id'> <i class='bi bi-x'> </i> Desactivar</a>" 
                    : "<a class='dropdown-item text-success btnCambiarEstado' href='#!' estado='$row->estado' nombre='$row->nombre'  codigo='$row->id'> <i class='bi bi-check2'> </i> Activar</a>";

                    return '<div class="dropstart font-sans-serif position-static d-inline-block">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown0">
                                        <a class="dropdown-item btnMostrar" codigo="'.$row->id.'" href="#!"> <i class="bi bi-card-heading"></i> Mostrar</a>
                                        <a class="dropdown-item btnActualizar" href="#!" codigo="'.$row->id.'"> <i class="bi bi-pencil-square"></i> Actualizar</a>
                                        <a class="dropdown-item text-danger btnEliminar" href="#!" codigo="'.$row->id.'"> <i class="bi bi-trash"></i> Eliminar</a>

                                        <a class="dropdown-item text-danger btnDeleteImagenes" href="#!" codigo="'.$row->id.'"> <i class="bi bi-trash"></i> Eliminar Imagenes</a>
                                        
                                        <div class="dropdown-divider"></div>
                                        '. $btnActivo .'
                                </div>
                            </div>';
                })
                ->addColumn('estado', function ($row) {
                    return $row->estado == 'ACTIVO' 
                        ? "<span class='badge badge-success text-success'> <i class='bi bi-check2'> </i> Activo</span>" 
                        : "<span class='badge badge-danger text-danger'><i class='bi bi-x'> Inactivo</span>";
                })
                ->rawColumns(['action', 'estado'])
                ->make(true);
        }
    
        public function cambiarPaquete($id_paquete, Request $request)
        {
            $return = new stdClass();
            $return->code = 200;
            $return->message = "Se ha actualizado de forma correcta";
    
            try {
                $paquete = Paquetes_turisticos::where('id', $id_paquete)->first();
                $paquete->Estado = $request->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
                $paquete->save();
            } catch (\Throwable $th) {
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
                
                // Eliminar imágenes si existen
                if ($paquete->imagen1) {
                    Storage::disk('public')->delete($paquete->imagen1);
                }
                if ($paquete->imagen2) {
                    Storage::disk('public')->delete($paquete->imagen2);
                }
                if ($paquete->imagen3) {
                    Storage::disk('public')->delete($paquete->imagen3);
                }
    
                $paquete->delete();
            } catch (\Exception $e) {
                $return->message = $e->getMessage();
                $return->code = 500;
            }
            return response()->json($return, $return->code);
        }


        //para borrar las imagenes de los paquetes 

        public function deleteImagenes($id_paquete, Request $request)
        {
            $return = new stdClass();
            $return->code = 200;
            $return->message = "Se ha eliminado la imagen de forma correcta";
        
            try {
                $paquete = Paquetes_turisticos::findOrFail($id_paquete);
        
               
                    if ($paquete->imagen1) {
                        Storage::disk('public')->delete($paquete->imagen1);
                        $paquete->imagen1 = null;
                    }
               
                    if ($paquete->imagen2) {
                        Storage::disk('public')->delete($paquete->imagen2);
                        $paquete->imagen2 = null;
                    }
             
       
                    if ($paquete->imagen3) {
                        Storage::disk('public')->delete($paquete->imagen3);
                        $paquete->imagen3 = null;
                    }
        
                // Guardar los cambios en la base de datos
                $paquete->save();
        
            } catch (\Throwable $th) {
                $return->message = $th->getMessage();
                $return->code = 500;
            }
        
            return response()->json($return, $return->code);
        }
        
        
    }
    


