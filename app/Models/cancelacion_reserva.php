<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cancelacion_reserva extends Model
{
    use HasFactory;

    protected $table = 'cancelacion_reserva';

    protected $fillable = [
        'motivo',
        'acepta',
        'fk_IdReservacion',
    ];
}