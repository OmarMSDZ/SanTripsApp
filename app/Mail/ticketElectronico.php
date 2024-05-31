<?php

namespace App\Mail;

use App\Models\Paquetes_turisticos;
use App\Models\Reservacion;
use App\Models\Ticket_electronico;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Psy\Output\Theme;

class ticketElectronico extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

  public $user;
  public $paqueteReserva;
 
  public $ticket;
    public function __construct($idusuario, $idreserva)
    {
        //
        // Consulta para obtener el usuario por ID
        $userQuery = User::all()->where('id', $idusuario)->first();
        //consulta para traer informacion de un solo paquete basandonos en el id
       

        $paqueteReservaQuery = DB::table('reservacion as r')
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
        


            $ticketQuery = DB::table('ticket_electronico as t')
            ->select(
                // Información del ticket
                't.Id AS id',
                't.Fecha AS fecha',
                't.Codigo AS codigo',
                't.Valido_hasta AS validohasta',
                't.Punto_encuentro AS puntoencuentro',
                // Información del empleado
                'e.Nombres AS nombreempleado',
                'e.Apellidos AS apellidoempleado',
                'e.Telefono AS telefonoempleado',
                'e.Email AS emailempleado'
            )
            ->join('empleados as e', 'e.id', '=', 't.id_empleado')
            ->where('t.fk_IdReservacion', '=', $idreserva)
            ->where('t.fk_idusuario', '=', $idusuario)
            ->first();
        
        //enviar resultado de la consulta de usuario a la vista
        $this->user = $userQuery;
                
        //enviar resultado de la consulta de paquete a la vista
        $this->paqueteReserva = $paqueteReservaQuery;
        
        //enviar resultado de la consulta de ticket electronico a la vista
        $this->ticket = $ticketQuery;
        



    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Electronico de La Reservación',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Mails.TicketReserva',
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
