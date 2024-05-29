<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use App\Models\Detalle_reserva;
use Illuminate\Http\Request;

use stdClass;

class ReservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         return view('usuario.formulario_reservas');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('usuario.reservas_realizadas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'paquete_id' => 'required',
            'usuario_id' => 'required',
            
            // Otros campos de reserva...
            'FechaSeleccionada' => 'required',
            'CantidadPersonas' => 'required',
            'MontoTotal' => 'required',
            'MetodoPago' => 'required',
            
        ]);
 

        $reserva = Reservacion::create([
            'FechaSeleccionada' => $request->input('FechaSeleccionada'),
            'Detalles_adicionales' => $request->input('DetallesAdicionales'),
            'MontoTotal' => $request->input('MontoTotal'),
            'CantidadPersonas' => $request->input('CantidadPersonas'),
            'MetodoPago' => $request->input('MetodoPago'),
            'fk_IdMetodopago' => $request->input('MetodoPago'),
            'fk_IdUsuario' => $request->usuario_id,
            'EstadoReservacion' => 'pendiente de pago',

            'fecha_expiracion' => now()->addMinutes(60),
        ]);          

        
        Detalle_reserva::create($request->only('id_paquete_turistico','fk_IdReservacion') + [
            
            'id_paquete_turistico' => $request->input('paquete_id'),
            'fk_IdReservacion' => $reserva->IdReservacion 
        ]);
                            
        // Redireccionar con un mensaje de éxito
        return redirect()->route('reservas_realizadas')->with('warning', 'Se ha Realizado con exito su reserva!, expirará dentro de 1 hora en caso de no proceder con el pago');
        
    }

    //para cambiar el estatus a activo luego de pagar
    public function cambiarEstatus($idreservacion){
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        try {
            $reserva = Reservacion::where('IdReservacion', $idreservacion)->first();
            $reserva->EstadoReservacion = 'ACTIVA';
            $reserva->save();
        } catch (\Throwable $th) {
            $return->message = $th->getMessage();
            $return->code = 500;
        }
       
        return redirect()->route('reservas_realizadas');
    }

 
}
