<?php

namespace App\Http\Controllers;

use App\Mail\FacturaMail;
use App\Mail\ticketElectronico;
use App\Models\Reservacion;
use App\Models\Detalle_reserva;
use App\Models\Factura;
use App\Models\Ticket_electronico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

    //para cambiar el estatus a activo luego de pagar y enviar ticket electronico
    public function cambiarEstatus($idreservacion){
        $return = new stdClass();
        $return->code = 200;
        $return->message = "Se ha actualizado de forma correcta";

        // try {
            $reserva = Reservacion::where('IdReservacion', $idreservacion)->first();
            $reserva->EstadoReservacion = 'ACTIVA';
            $reserva->save();

             // Buscar id del encargado del paquete
     // Buscar id del encargado del paquete
     $encargado = DB::table('reservacion as r')
     ->select('e.id as idemp')
     ->join('detalle_reserva as dr', 'r.IdReservacion', '=', 'dr.fk_IdReservacion')
     ->join('paquetes_turisticos as p', 'dr.id_paquete_turistico', '=', 'p.id')
     ->join('encargados_paquetes as ep', 'p.id', '=', 'ep.id_paquete_turistico')
     ->join('empleados as e', 'ep.id_empleado', '=', 'e.id')
     ->where('r.IdReservacion', $idreservacion)
     ->first();

 if (!$encargado) {
     throw new \Exception('Encargado del paquete no encontrado.');
 }
//  $encargado = (array) $encargado;
//  Log::info('Encargado encontrado', ['encargado_id' => $encargado->id]);

 // Generar el código para el ticket electrónico
 $codigoTicket = $this->generateUniqueCode();

 Log::info('Código de ticket generado', ['codigoTicket' => $codigoTicket]);

 // Buscar el punto de encuentro de la reserva en el paquete turístico
 $puntoEncuentro = DB::table('reservacion as r')
 ->select('p.PuntoEncuentro as puntoencuentro')
 ->join('detalle_reserva as dr', 'r.IdReservacion', '=', 'dr.fk_IdReservacion')
 ->join('paquetes_turisticos as p', 'dr.id_paquete_turistico', '=', 'p.id')
 ->where('r.IdReservacion', $idreservacion)
 ->first();


 if (!$puntoEncuentro) {
     throw new \Exception('Punto de encuentro no encontrado.');
 }
//  $puntoEncuentroValue = $puntoEncuentro ? $puntoEncuentro->puntoencuentro : null;
 Log::info('Punto de encuentro encontrado', ['puntoencuentro' => $puntoEncuentro->puntoencuentro]);

 // Id del usuario
 $userId = Auth::user()->id;
 $fechaticket = now()->toDateString();
 $fechareserva = Reservacion::find($idreservacion)->FechaSeleccionada;
 // Crear el ticket electrónico luego de pagar
 
 Ticket_electronico::create([
    'Fecha' => $fechaticket,
    'Codigo' => $codigoTicket,
    'Valido_hasta' => $fechareserva,
    'Punto_encuentro' => $puntoEncuentro->puntoencuentro,
    'fk_IdReservacion' => $idreservacion,
    'id_empleado' => $encargado->idemp,
    'fk_IdUsuario' => $userId,
]);

//  Crear la factura de la reserva a la hora de pagar
 $descripcionFactura= DB::table('reservacion as r')
 ->select('p.Nombre as nombrepaq', 'p.Costo as costopersona','o.Porcentaje as porciento')
 ->join('detalle_reserva as dr', 'r.IdReservacion', '=', 'dr.fk_IdReservacion')
 ->join('paquetes_turisticos as p', 'dr.id_paquete_turistico', '=', 'p.id')
 ->join('ofertas as o', 'p.fk_IdOferta', '=', 'o.IdOferta')
 ->where('r.IdReservacion', $idreservacion)
 ->first();

//   dd($descripcionFactura);
 

 $fechaFactura = now()->toDateString();
 
 $montoFactura = (float)  Reservacion::find($idreservacion)->MontoTotal;
//  $descuentosPorcentajeFactura = (float) $descripcionFactura->porciento;
 $descuentosPorcentajeFactura = $descripcionFactura->porciento;
 
 $montoDescontado = ($descuentosPorcentajeFactura/100) * ($montoFactura * $descuentosPorcentajeFactura);
 $montopendiente = '0';

 $factura = Factura::create([
    'Fecha' => $fechaFactura,
    'Descripcion' => $descripcionFactura->nombrepaq,
    'Monto' =>  $montoFactura,
    'Descuentos' => $montoDescontado,
    'Monto_pendiente' => $montopendiente,
    'fk_IdReservacion' => $idreservacion,
 ]);
 
 $idfactura= $factura->NumFactura;



    //enviar los correos al email del usuario que activa este controlador, y esta logueado, luego de pagar
    Mail::to(Auth::user()->email)
    ->send(new ticketElectronico($userId, $idreservacion));

    Mail::to(Auth::user()->email)
    ->send(new FacturaMail($userId, $idreservacion, $idfactura));



        // } catch (\Throwable $th) {
        //     $return->message = $th->getMessage();
        //     $return->code = 500;
        // }
       
        return redirect()->route('reservas_realizadas');
    }

 
    /**
 * Generar un codigo alfanumerico de 14 digitos que sea unico
 *
 * @return string
 */
private function generateUniqueCode()
{
    do {
        $code = Str::random(14);
    } while (DB::table('ticket_electronico')->where('Codigo', $code)->exists()); // Suponiendo que la tabla donde guardas los códigos es 'tickets'

    return $code;
}

}
