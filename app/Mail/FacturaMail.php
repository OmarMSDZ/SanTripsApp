<?php

namespace App\Mail;

use App\Models\Factura;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class FacturaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $user;
     public $paqueteReserva;
     public $factura;
     
    public function __construct(
        $idusuario,
        $idreserva,
        $idfactura
    )
    {
        //consulta para obtener el usuario
        $userQuery = User::all()->where('id', $idusuario)->first();

        //traer info de paquete y reserva especifica
        $paqueteReservaQuery = DB::table('incidente as inc')
            ->select(
                'p.id as idpaq',
                'p.Nombre as nombre',
                'p.Descripcion as descripcion',
                'p.Costo as costo',
                'p.Num_personas as numpersonas',
                'p.Edades as edades',
                'p.Idiomas as idiomas',
                'p.Alojamiento as alojamiento',
                'p.Tiempo_estimado as tiempoestimado',
                'p.Disponibilidad as disponibilidad',
                'p.Horainicio as horainicio',
                'tip.nombre as categoria',
                'o.Porcentaje as porciento',
                'r.IdReservacion as idreserva',
                'r.FechaSeleccionada as fechaseleccionada',
                'r.MontoTotal as montototal',
                'r.CantidadPersonas as cantpersonasreserva',
                'r.EstadoReservacion as estadoreservacion'
            )
            ->join('detalle_reserva as dr', 'r.IdReservacion', '=', 'dr.fk_IdReservacion')
            ->join('paquetes_turisticos as p', 'p.id', '=', 'dr.id_paquete_turistico')
            ->join('tipos as tip', 'tip.id', '=', 'p.id_categoria_paquete')
            ->join('ofertas as o', 'o.IdOferta', '=', 'p.fk_IdOferta')
            ->where('r.IdReservacion', '=', $idreserva)
            ->first();

            // //traer info de factura especifica de la reserva
            // $factura = DB::table('factura')
            // ->select('SELECT * from factura')
            // ->where('fk_IdReservacion', $idreserva)
            // ->first();
            $factura = Factura::select(
                'NumFactura as numero',
                'Fecha as fecha',
                'Descripcion as descripcion',
                'Monto as monto',
                'Descuentos as descuentos',
                'Monto_pendiente as montopendiente',   
            )->where('NumFactura', $idfactura)->first();
// dd($factura);
        //enviar resultado de la consulta de usuario a la vista
        $this->user = $userQuery;
                
        //enviar resultado de la consulta de paquete a la vista
        $this->paqueteReserva = $paqueteReservaQuery;
        
        //enviar resultado de la consulta de factura a la vista
        $this->factura = $factura;


    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Factura de la Reservación '.now()->toDateString(),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Mails.Factura',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
