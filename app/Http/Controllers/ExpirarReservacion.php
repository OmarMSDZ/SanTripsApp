<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpirarReservacion extends Controller
{
    //Controlador para poder expirar una reserva especifica

    public function expirarReservacion($idReservacion)
    {
        // Obtener la reserva que ha expirado
        $reservaVencida = Reservacion::where('IdReservacion', $idReservacion)
                                    ->where('fecha_expiracion', '<', now())
                                    ->where('EstadoReservacion', '!=', 'EXPIRADA')
                                    ->where('EstadoReservacion', '=', 'PAGO PENDIENTE')
                                    ->first();
    
        // Verificar si se encontró una reserva vencida
        if ($reservaVencida) {
            // Marcar la reserva como expirada
            $reservaVencida->EstadoReservacion = "EXPIRADA";
            $reservaVencida->save();
    
            // return response()->json(['message' => 'La Reserva Ha Expirado.']);
            return redirect()->route('reservas_realizadas')->with('error', 'La Reserva Ha Expirado');
        } else {
            // No se encontró ninguna reserva vencida con el ID dado
            // return response()->json(['message' => 'No se encontró ninguna reserva vencida con el ID dado.'], 404);
            return redirect()->route('reservas_realizadas')->with('error', 'Esta Reserva no esta vencida');
        }
    }
    
}
