<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias_paquetes extends Model
{
    use HasFactory;

    //campos de la tabla
    protected $fillable = ['IdCategoriapaq','Categoriapaq'];

    // Specify the primary key
    protected $primaryKey = 'IdCategoriapaq';

}
