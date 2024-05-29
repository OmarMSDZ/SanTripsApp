<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_electronico extends Model
{
    use HasFactory;

    protected $fillable = ['Fecha', 'Codigo', 'Valido_hasta', 'Punto_encuentro', 'fk_IdReservacion', 'fk_IdEmpleado', 'fk_IdUsuario'];
    protected $table = 'ticket_electronico';
    protected $primaryKey = 'Id';
    
}
