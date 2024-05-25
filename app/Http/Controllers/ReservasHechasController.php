<?php

namespace App\Http\Controllers;

use App\Models\Detalle_reserva;
use App\Models\Reservacion;
use App\Models\ReservasHechas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
use stdClass;

class ReservasHechasController extends Controller
{
    //

      /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //se hace de esta manera para que funcione el filtro
        $estado = $request->input('estado');


        $query = "
        SELECT 
            r.IdReservacion as idreserva,
            r.FechaSeleccionada as fechareserva,
            r.MontoTotal as montoreserva,
            r.CantidadPersonas as cantpersonasreserva,
            r.EstadoReservacion as estado,
            p.Nombre as nombrepaquete,
            u.name as usuario
        FROM reservacion as r 
        INNER JOIN detalle_reserva as dr ON r.IdReservacion = dr.fk_IdReservacion
        INNER JOIN paquetes_turisticos as p ON p.id = dr.id_paquete_turistico
        INNER JOIN users as u ON u.id = r.fk_IdUsuario
    ";

    if ($estado) {
        $query .= " WHERE r.EstadoReservacion = :estado";
        $reservas = DB::select($query, ['estado' => $estado]);
    } else {
        $reservas = DB::select($query);
    }



        return view('admin.adminreservas', compact('reservas'));
    }

    //retornar la vista detallada de cada reserva
    public function vistaDetallada()
    {
        
        return view('admin.vistadetalladareserva');
    }

    //la de procesar te envia a la de mostrar formulario
    public function procesarReservaVistaDetallada(Request $request)
    {
        $id = $request->input('id');
        // Redireccionamos al formulario de reserva con el ID del paquete
        return redirect()->route('reservashechas.vistaDetallada', ['id' => $id]);
    }

    public function mostrarFormularioVistaDetallada($id)
    {

        $reservas = DB::select(
            "SELECT 
            r.IdReservacion as idreserva,
            r.FechaSeleccionada as fechareserva,
            r.MontoTotal as montoreserva,
            r.CantidadPersonas as cantpersonasreserva,
            r.EstadoReservacion as estado,
            
            p.Nombre as nombrepaquete,

            u.name as usuario

            FROM reservacion as r 
            INNER JOIN
            detalle_reserva as dr ON  r.IdReservacion=dr.fk_IdReservacion
            INNER JOIN paquetes_turisticos as p ON p.id=dr.id_paquete_turistico
            INNER JOIN users as u ON u.id=r.fk_IdUsuario WHERE r.IdReservacion=$id"    
            
        );
        // Pasamos el id a la vista
        return view('admin.vistadetalladareserva', compact('id', 'reservas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id_reserva, Request $request)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {
            $request->validate([
                'estado' => 'required|string',
            
            ]);
            $reserva = Reservacion::where('IdReservacion', $id_reserva)->first();
        
            $reserva->FechaSeleccionada = $request->cambiarFecha;
            $reserva->EstadoReservacion = $request->estado;
            $reserva->save();
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }

   
      return  redirect()->route('reservashechas.index');

    }

    public function destroy($id_reserva)
    {
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Registro eliminado correctamente";
    
        try {
            DB::beginTransaction();
    
            // Encuentra la reserva y elimina los detalles relacionados
            $reserva = Reservacion::findOrFail($id_reserva);
            Detalle_reserva::where('fk_IdReservacion', $id_reserva)->delete();
    
            // Elimina la reserva
            $reserva->delete();
    
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $return->message = $e->getMessage();
            $return->code = 500;
        }
    
 
        return redirect()->route('reservashechas.index')->with('success', 'Registro eliminado correctamente');

    }
    

}
