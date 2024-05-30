<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Incidentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\IncidenteMail;

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

        // Enviar correos
        $idusuario =  Auth::user()->id;
        $idincidente = $incidente->IdIncidente;

        // Obtener la lista de correos de los administradores desde la base de datos
        $adminEmails = User::where('usertype', 'admin')->pluck('email');

        // Enviar el correo a cada administrador
        foreach ($adminEmails as $adminEmail) {
            Mail::to($adminEmail)->send(new IncidenteMail($idusuario, $idincidente));
        }

        // // También enviar el correo al usuario actual
        // Mail::to(Auth::user()->email)->send(new IncidenteMail($idusuario, $idincidente));

        // Redireccionar con un mensaje de éxito
        return redirect()->route('inicio')->with('success', 'Incidente creado correctamente');
    }
}
