<?php

namespace App\Http\Controllers;
use App\Models\ReservasHechas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservasHechasController extends Controller
{
    //

      /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        return view('admin.adminreservas');
    }
}
