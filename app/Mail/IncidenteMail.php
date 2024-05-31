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

class IncidenteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $incidente;

    public function __construct($idusuario, $idincidente)
    {
        // Consulta para obtener el usuario
        $this->user = User::find($idusuario);

        // Consulta para obtener los detalles del incidente y el usuario
        $this->incidente = DB::table('incidentes as inc')
            ->select(
                'inc.FechaIncidente as fechaIncidente',
                'inc.Descripcion as descripcionIncidente',
                'tip.nombre as tipoIncidente',
                'inc.fk_IdUsuario as idUsuario',
                'u.nombres as nombresUsuario',
                'u.apellidos as apellidosUsuario',
                'u.telefono as telefonoUsuario',
                'u.email as emailUsuario'
            )
            ->join('users as u', 'inc.fk_IdUsuario', '=', 'u.id')
            ->join('tipos as tip', 'inc.fk_IdTipoIncidente', '=', 'tip.id')
            ->where('inc.IdIncidente', '=', $idincidente)
            ->first();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Incidente Reportado',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Mails.IncidentesMail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
