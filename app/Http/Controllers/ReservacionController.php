<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use App\Models\Detalle_reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'DetallesAdicionales' => '',
            'CantidadPersonas' => 'required',
            'MontoTotal' => 'required',
            'MetodoPago' => 'required',
            
        ]);
        // dd($validatedData);

       
           
            $reserva = Reservacion::create($request->only('FechaSeleccionada', 'DetallesAdicionales','MontoTotal','CantidadPersonas', 'MetodoPago', 'usuario_id' ) + [
                'fk_IdMetodopago' => $request->input('MetodoPago'),
                'fk_IdUsuario' => $request->input('usuario_id') 
            ]);

          

         

     
            Detalle_reserva::create($request->only('id_paquete_turistico','fk_IdReservacion') + [
                
                'id_paquete_turistico' => $request->input('paquete_id'),
                'fk_IdReservacion' => $reserva->IdReservacion 
            ]);

            

            // Redireccionar con un mensaje de éxito
            return redirect()->route('reservas_realizadas')->with('success', 'Reserva creada correctamente.');
    
    }

 
}
