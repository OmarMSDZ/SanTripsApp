<?php

namespace App\Http\Controllers;

use App\Models\Incidentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class AdminIncidentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

      //se hace de esta manera para que funcione el filtro
      $estado = $request->input('estado');


      $query = "
      SELECT 
      i.IdIncidente as idincidente,
      i.FechaIncidente as fechaincidente,
      i.Descripcion as descripcion,
      ti.IdTipoIncidente as idtipoincidente,
      ti.TipoIncidente as tipoincidente,
      i.fk_IdUsuario as idusuario
      FROM incidentes as i

      INNER JOIN tipo_incidente as ti ON i.fk_IdTipoIncidente = ti.IdTipoIncidente
      ";

  if ($estado) {
      $query .= " WHERE i.EstadoIncidente = :estado";
      $incidentes = DB::select($query, ['estado' => $estado]);
  } else {
      $incidentes = DB::select($query);

     $tipos_incidente = Incidentes::all();
     return view('admin.adminincidentes',['incidentes' => $incidentes], compact('tipos_incidente'));
  }


    }
//retornar la vista detallada de cada incidente
public function vistaDetalladaIncidente()
{
    
    return view('admin.vistadetalladaincidente');
}

//la de procesar te envia a la de mostrar formulario
// public function procesarIncidenteVistaDetallada(Request $request)
//     {
//         $id = $request->input('id');
//         // Redireccionar al formulario de reserva con el ID del paquete
//         return redirect()->route('reservashechas.vistaDetallada', ['id' => $id]);
//     }

public function mostrarFormularioVistaDetallada($id)
{

    $incidentes = DB::select(
        "SELECT
            i.IdIncidente as idincidente,
            i.FechaIncidente as fechaincidente,
            i.Descripcion as descripcion,
            ti.IdTipoIncidente as idtipoincidente,
            ti.TipoIncidente as tipoincidente,
            i.fk_IdUsuario as idusuario
        FROM incidentes as i
        INNER JOIN tipo_incidente as ti ON i.fk_IdTipoIncidente = ti.IdTipoIncidente
        WHERE i.IdIncidente = :id",
        ['id' => $id]
    );
    // Pasamos el id a la vista
    return view('admin.vistadetalladaincidente', compact('id', 'incidentes'));
}

/**
 * Update the specified resource in storage.
 */
public function update($id_incidente, Request $request)
{
    $return = new stdClass();
    $return->code = 200;
    $return->message = "Se ha actualizado de forma correcta";

    try {
        $request->validate([
            'estado' => 'required|string',
        ]);

       $incidente = Incidentes::where('IdIncidente', $id_incidente)->first();
        $incidente->Descripcion = $request->descripcion;
        $incidente->fk_IdTipoIncidente = $request->fk_IdTipoIncidente;

        $estadoIncidente = $request->input('estado');
        $incidente->EstadoIncidente = $estadoIncidente;

        $incidente->save();
    } catch (\Throwable $th) {
        $return->message = $th->getMessage();
        $return->code = 500;
    }


  return  redirect()->route('adminincidentes.index');

}

public function destroy($id_incidente)
{
    $return = new stdClass();
    $return->code = 200;
    $return->message = "Registro eliminado correctamente";

    try {
        DB::beginTransaction();

        // Encuentra el incidente y elimina el registro
        $incidente = Incidentes::findOrFail($id_incidente);
       

        // Elimina la reserva
        $incidente->delete();

        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        $return->message = $e->getMessage();
        $return->code = 500;
    }


    return redirect()->route('adminincidentes.index')->with('success', 'Registro eliminado correctamente');

}
}
