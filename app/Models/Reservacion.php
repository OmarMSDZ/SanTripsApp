<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdReservacion',
        'FechaSeleccionada',
        'Detalles_adicionales',
        'MontoTotal',
        'CantidadPersonas',
        'fk_IdMetodopago',
        'fk_IdUsuario'
    
    ];

    protected $primaryKey = 'IdReservacion';
    protected $table = 'reservacion'; // nombre de la tabla
}
