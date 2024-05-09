<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function procesarReserva(Request $request)
    {
        $id = $request->input('id');
        // Redireccionamos al formulario de reserva con el ID del paquete
        return redirect()->route('formulario_reserva', ['id' => $id]);
    }

    public function mostrarFormulario($id)
    {
        // Pasamos el id a la vista
        return view('usuario.formulario_reservas', compact('id'));
    }

}
 