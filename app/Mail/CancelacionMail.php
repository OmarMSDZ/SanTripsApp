<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CancelacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cancelacion;

    public function __construct($idusuario, $idcancelacion)
    {
        // Consulta para obtener el usuario
        $this->user = User::find($idusuario);

        // Consulta para obtener los detalles de la cancelación y el usuario
        $this->cancelacion = DB::table('cancelacion_reserva as cr')
            ->select(
                'cr.motivo as motivo',
                'cr.acepta as acepta',
                'res.MontoTotal as monto',
                'res.FechaSeleccionada as fecha',
                'cr.fk_IdReservacion as reservacion',
                'u.nombres as nombresUsuario',
                'u.apellidos as apellidosUsuario',
                'u.telefono as telefonoUsuario',
                'u.email as emailUsuario'
            )
            ->join('reservacion as res', 'cr.fk_IdReservacion', '=', 'res.IdReservacion')
            ->join('users as u', 'res.fk_IdUsuario', '=', 'u.id')
            ->where('cr.id', '=', $idcancelacion)
            ->first();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cancelación de reserva',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Mails.cancelacionmail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
