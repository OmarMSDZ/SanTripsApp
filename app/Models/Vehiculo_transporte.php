<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo_transporte extends Model
{
    use HasFactory;

    protected $primaryKey = 'IdVehiculo';

    //nombre de la tabla declarado explicitamente
    protected $table = 'vehiculo_transporte';
}
