<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdDetalleReserva', 
        'cantidad',
        'fk_IdPaquete',
        'fk_IdReservacion'
        
    ];

    protected $primaryKey = 'IdDetalleReserva';

    protected $table = 'detalle_reserva';
    
    
}
