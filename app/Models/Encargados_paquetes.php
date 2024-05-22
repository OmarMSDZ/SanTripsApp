<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargados_paquetes extends Model
{
    use HasFactory;
    
       //campos de la tabla
       protected $fillable = 
       [
       'id',
       'Fecha',
       'id_paquetes_turistico',
       'id_empleado'
       ];
   
       protected $primaryKey = 'id';

       protected $table = 'encargados_paquetes';
}
