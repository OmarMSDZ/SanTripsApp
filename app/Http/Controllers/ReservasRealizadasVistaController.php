<?php

namespace App\Http\Controllers;

use App\Models\cancelacion_reserva;
use App\Models\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelacionMail;

class ReservasRealizadasVistaController extends Controller
{
    public function index()
    {
        $idusuario = Auth::user()->id;

        $usuarios = DB::select("SELECT id, name, email FROM users WHERE id = ?", [$idusuario]);

        $reservas = DB::select("
            SELECT 
                r.IdReservacion, 
                p.Nombre, 
                p.Horainicio,
                r.FechaSeleccionada, 
                r.fecha_expiracion,
                r.CantidadPersonas, 
                mp.Metodo_Pago,
                r.EstadoReservacion,
                dr.id_paquete_turistico,
                dr.fk_IdReservacion
            FROM reservacion AS r 
            INNER JOIN detalle_reserva AS dr ON r.IdReservacion = dr.fk_IdReservacion 
            INNER JOIN paquetes_turisticos AS p ON p.id = dr.Id_paquete_turistico 
            INNER JOIN metodo_pago AS mp ON mp.IdMetodopago = r.fk_IdMetodopago  
            WHERE r.fk_IdUsuario = ? 
            AND (r.EstadoReservacion = 'ACTIVA' 
                OR r.EstadoReservacion = 'PAGO PENDIENTE' 
                OR r.EstadoReservacion = 'EN PROCESO' 
                OR r.EstadoReservacion = 'COMPLETADA')
        ", [$idusuario]);

        return view('usuario.reservas_realizadas', compact('idusuario', 'usuarios', 'reservas'));
    }

    public function cancelarReservacion(Request $request)
    {
        try {
            $reservacion = Reservacion::where('IdReservacion', $request->id_reserva)->first();
    
            // Obtener fecha actual y de la reserva
            $date = date('Y-m-d');
            $datereserva = $request->fecha_reserva;
            
            // Verificar que no se cancele en la misma fecha de la reserva
            if ($datereserva != $date) {
                if ($reservacion) {
                    $reservacion->EstadoReservacion = 'CANCELADA';
                    $reservacion->save();

                    // Guardar también en la tabla de cancelación de reserva 
                    $cancelacion_reserva = new cancelacion_reserva();
                    $cancelacion_reserva->motivo = $request->motivocancelacion;
                    $cancelacion_reserva->acepta = $request->reembolsoSi;
                    $cancelacion_reserva->fk_IdReservacion = $request->id_reserva;
                    $cancelacion_reserva->save();

                    // Enviar correo electrónico de cancelación
                    $idusuario = Auth::user()->id;
                    $idcancelacion = $cancelacion_reserva->id;

                    Mail::to(Auth::user()->email)->send(new CancelacionMail($idusuario, $idcancelacion));

                    return redirect()->route('reservas_realizadas')->with('success', 'Reservación cancelada correctamente y Correo de cancelacion enviado correctamente');
                } else {
                    return redirect()->route('reservas_realizadas')->with('error', 'Reservación no encontrada');
                }
            } else {
                return redirect()->route('reservas_realizadas')->with('error', 'No se puede cancelar una reservación en la misma fecha de la reserva');
            }
        } catch (\Throwable $th) {
            return redirect()->route('reservas_realizadas')->with('error', 'Ocurrió un error: ' . $th->getMessage());
        }
    }
}
