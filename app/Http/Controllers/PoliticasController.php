<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidentes;

class PoliticasController extends Controller
{
    // Otras funciones del controlador...

    public function index() {
        return view('usuario.politicas');
    }
}
