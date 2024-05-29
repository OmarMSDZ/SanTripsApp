<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculoEmpleado extends Model
{
    use HasFactory;

    // Campos de la tabla
    protected $fillable = [
        'IdAsignacion',
        'FechaAsignacion',
        'id_empleado',
        'fk_IdVehiculo'
    ];

    protected $table = 'asignacion_vehiculo';
    // Clave primaria de la tabla
    protected $primaryKey = 'IdAsignacion';
    
}
