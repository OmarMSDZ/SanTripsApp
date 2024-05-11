<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    public function index() {

        $tipos_destinos = Tipo::select('id', 'nombre')->where('activo', 1)->get();

        return view('admin.admindestinos', compact('tipos_destinos'));
    }
}
