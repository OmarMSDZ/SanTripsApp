<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquetes_turisticos extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdPaquete',
        'Nombre',
        'Descripcion',
        'Costo',
        'Num_personas',
        'Edades',
        'Idiomas',
        'Alojamiento',
        'Tiempo_estimado',
        'Disponibilidad',
        'fk_IdCategoriapaq',
        'fk_IdOferta'
    ];

    protected $primaryKey = 'IdPaquete';

    protected $table = 'paquetes_turisticos';

    
}
