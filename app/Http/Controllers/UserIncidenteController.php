<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidentes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserIncidenteController extends Controller
{
    public function index()
    {
        $TiposIncidentes = DB::select("select id, nombre from tipos where tipo = 'incidentes'");

        return view('usuario.incidentes', compact('TiposIncidentes'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fechaincidente' => 'required|date',
            'tipoincidente' => 'required|integer',
            'descripcionincidente' => 'required|string',
        ]);

        // Crear un nuevo incidente
        $incidente = new Incidentes();
        $incidente->FechaIncidente = $request->fechaincidente;
        $incidente->Descripcion = $validatedData['descripcionincidente'];
        $incidente->fk_IdTipoIncidente = $validatedData['tipoincidente'];
        $incidente->fk_IdUsuario = $user_id;
        $incidente->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('inicio')->with('success', 'Incidente creado correctamente');
    }
}
