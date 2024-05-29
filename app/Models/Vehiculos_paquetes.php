<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculos_paquetes extends Model
{
    // campos de la tabla
protected $fillable = [
    'IdVehiculosPaquetes',
    'id_paquetes_turistico',
    'fk_IdVehiculo'
];

    protected $primaryKey = 'IdVehiculosPaquetes';
}