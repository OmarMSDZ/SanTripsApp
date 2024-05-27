<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use App\Models\Detalle_reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\PayPalService;
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
            'DetallesAdicionales' => '',
            'CantidadPersonas' => 'required',
            'MontoTotal' => 'required',
            'MetodoPago' => 'required',
            
        ]);
 

 $reserva = Reservacion::create([
            'FechaSeleccionada' => $request->input('FechaSeleccionada'),
            'DetallesAdicionales' => $request->input('DetallesAdicionales'),
            'MontoTotal' => $request->input('MontoTotal'),
            'CantidadPersonas' => $request->input('CantidadPersonas'),
            'MetodoPago' => $request->input('MetodoPago'),
            'fk_IdMetodopago' => $request->input('MetodoPago'),
            'fk_IdUsuario' => $request->usuario_id,
            'EstadoReservacion' => 'pendiente de pago',
            // 'fecha_creacion' => now(),
            'fecha_expiracion' => now()->addMinutes(60),
        ]);          



            // Crear la reserva
            // $reserva = Reservacion::create([
            //     // Asignar los campos de la reserva
            //     // $validatedData['campo']...
            // ]);
           
            $reserva = Reservacion::create($request->only('FechaSeleccionada', 'DetallesAdicionales','MontoTotal','CantidadPersonas', 'MetodoPago', 'usuario_id' ) + [
                'fk_IdMetodopago' => $request->input('MetodoPago'),
                'fk_IdUsuario' => $request->input('usuario_id') 
            ]);

            // dd($reserva);

         

            Detalle_reserva::create($request->only('id_paquete_turistico','fk_IdReservacion') + [
                
                'id_paquete_turistico' => $request->input('paquete_id'),
                'fk_IdReservacion' => $reserva->IdReservacion 
            ]);
                //obtener el id de la reserva creada
          

               //redirigir a paypal
         
                 
            // Redireccionar con un mensaje de éxito
            return redirect()->route('reservas_realizadas')->with('success', 'Se ha Realizado con exito su reserva, proceda con el pago para terminar este proceso');

            
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
        // return response()->json($return, $return->code);
        return redirect()->route('reservas_realizadas');
    }

 
}
