<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidentes extends Model
{
    // Campos de la tabla
    protected $fillable = [
        'IdIncidente',
        'FechaIncidente',
        'Descripcion',
        'fk_IdTipoIncidente',
        'fk_IdUsuario',
        'EstadoIncidente'
    ];

    protected $primaryKey = 'id';
}
