<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ofertas extends Model
{
    use HasFactory;

    //campos de la tabla
    protected $fillable = 
    [
    'IdOferta',
    'Descripcion',
    'Porcentaje',
    'FechaDesde',
    'FechaHasta'
    ];

    protected $primaryKey = 'IdOferta';
}
