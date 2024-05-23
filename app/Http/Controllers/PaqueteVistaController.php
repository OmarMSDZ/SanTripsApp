<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaqueteVistaController extends Controller
{
    //para la vista de paquetes en las interfaces de usuarios

    public function index (){
        $paquetes = DB::select("SELECT p.id as idpaq, p.Nombre as nombre, p.Descripcion as descripcion,
        p.Costo as costo, p.Num_personas as numpersonas, p.Edades as edades, p.Idiomas as idiomas, p.Alojamiento as alojamiento, p.Tiempo_estimado as tiempoestimado, 
        p.Disponibilidad as disponibilidad, c.nombre as categoria, o.Porcentaje as porciento, p.imagen1 as imagen1 FROM
        paquetes_turisticos as p INNER JOIN tipos as c ON p.fk_IdCategoriaPaq=c.id INNER JOIN ofertas as o ON p.fk_IdOferta=o.IdOferta where c.tipo='paquetes'
        and p.Estado='ACTIVO'");

     
        
        return view('usuario.paquetes', compact('paquetes'));
        
    }

}
