<?php
namespace Tests\Unit;

use App\Http\Controllers\ReservacionController;
use Tests\TestCase;
use App\Models\Reservacion;
 
use Illuminate\Http\Request;
 

class ReservacionTest extends TestCase
{
  

    public function test_registro_de_reserva()
    {

            // PROBAR CREACION DE RESERVA  
            $request = new Request([
            'paquete_id' => 1,
            'usuario_id' => 1,
            'MetodoPago' => 1,
                
            'FechaSeleccionada' => now(),
            'Detalles_adicionales' => 'prueba',
            'MontoTotal' => 12,
            'CantidadPersonas' => 1,
             
            'fk_IdMetodopago' => 1,
            'fk_IdUsuario' => 1,
            'EstadoReservacion' => 'pendiente de pago',

            'fecha_expiracion' => now()->addMinutes(60),
            ]);
    
            // LLAMAR EL METODO STORE DEL CONTROLADOR DE RESERVAS
            $response = (new ReservacionController)->store($request);
    
            // VERIFICAR QUE LA RESERVACION SE HA REALIZADO
            // CAMBIAR EL NUMERO A 1 DESPUES DE ELIMINAR TODAS LAS RESERVAS O PONER EL NUMERO DE RESERVAS QUE HABRÁN LUEGO DE EJECUTAR ESTA PRUEBA
            $this->assertCount(1, Reservacion::all());
     

          
 
    }

}
