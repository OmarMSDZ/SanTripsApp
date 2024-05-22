<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquetes_destinos extends Model
{
    use HasFactory;

       //campos de la tabla
       protected $fillable = 
       [
       'id',
       'id_paquetes_turistico',
       'id_destino'
       ];
   
       protected $primaryKey = 'id';

       protected $table = 'paquetes_destinos';
}
