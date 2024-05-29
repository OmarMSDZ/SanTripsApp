<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidentes extends Model
{
    use HasFactory;

    protected $table = 'incidentes';
    protected $primaryKey = 'IdIncidente';

    protected $fillable = [
        'FechaIncidente',
        'Descripcion',
        'fk_IdTipoIncidente',
        'fk_IdUsuario',
    ];

    // Definir relaciones si es necesario
    // public function tipoIncidente()
    // {
    //     return $this->belongsTo(Tipo_Incidente::class, 'fk_IdTipoIncidente', 'IdTipoIncidente');
    // }

    // public function usuario()
    // {
    //     return $this->belongsTo(User::class, 'fk_IdUsuario', 'IdUsuario');
    // }
}

