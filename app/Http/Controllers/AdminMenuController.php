<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMenuController extends Controller
{
    public function index()
    {
        //Mostrar la vista de adminmenu con las variables para el dashboard desde aqui
        
        $usuarios = DB::select('SELECT COUNT(*) AS count FROM users');
        
        
        $empleados = DB::select('SELECT COUNT(*) AS count FROM empleados');
        
        
        
        $paquetes = DB::select('SELECT COUNT(*) AS count FROM paquetes_turisticos');
        
        
        $destinos = DB::select('SELECT COUNT(*) AS count FROM destinos');
        
        
        $proveedores = DB::select('SELECT COUNT(*) AS count FROM proveedores');
        
        
        $vehiculos = DB::select('SELECT COUNT(*) AS count FROM vehiculo_transporte');
        
        
        $reservas = DB::select('SELECT COUNT(*) AS count FROM reservacion');
         

        return view('admin.adminmenu',
            compact(
                'usuarios', 
               
                'empleados',
         
                'paquetes', 
  
                'destinos',
 
                'proveedores',
 
                'vehiculos',

                'reservas' 
        ));
    }


}
