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
       'IdEncargadosPaquetes',
       'Fecha',
       'id_paquete_turistico',
       'id_empleado'
       ];
   
       protected $primaryKey = 'IdEncargadosPaquetes';

       protected $table = 'encargados_paquetes';
}
