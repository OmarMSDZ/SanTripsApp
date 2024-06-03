<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquetes_turisticos extends Model
{
    use HasFactory;

    protected $fillable= [
        'Nombre',
        'Descripcion',
        'Costo',
        'Num_personas',
        'Edades',
        'Idiomas',
        'Alojamiento',
        'Tiempo_estimado',
        'Disponibilidad',
        'Horainicio',
        'PuntoEncuentro',
        'imagen1',
        'imagen2',
        'imagen3',
        'Estado',
        'id_categoria_paquete',
        'fk_IdOferta'
        
    ];
 

    
 
}
