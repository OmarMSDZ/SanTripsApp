<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos_empleado extends Model
{
    use HasFactory;

    protected $table = 'cargos_empleado';

    protected $fillable = [
        'IdCargo',
        'Cargo',
        'Sueldo',
        'Responsabilidades'
    ];

    protected $primaryKey = 'IdCargo';

   
}
