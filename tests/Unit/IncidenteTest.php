<?php
namespace Tests\Unit;

use App\Http\Controllers\UserIncidenteController;
use Tests\TestCase;
use App\Models\Incidentes;
use App\Models\User;
use Illuminate\Http\Request;
 

class IncidenteTest extends TestCase
{

    public function test_registro_de_incidente()
    {

            // PROBAR CREACION DE INCIDENTE

            // Crear un usuario para la prueba
            $user = User::create([
            'name' => 'John Doex',
            'nombres' => 'John Doe',
            'apellidos' => 'John Doe',
            'telefono' => '8091231234',
            'email' => 'prueb@example.com',
            'password' => bcrypt('password'),
            'usertype' => 'user',
            'estado' => 'ACTIVO',
            ]);

            // SIMULAR INICIO DE SESION DEL USUARIO
            $this->actingAs($user);

            $request = new Request([
         
            'fechaincidente' => now(),
            'tipoincidente' => 25,
            'descripcionincidente' => 'prueba',


            'FechaIncidente' => now(),
            'Descripcion' => 'prueba',
            'Estado' => 'ACTIVO',
            'fk_IdTipoIncidente' => 25,
            'fk_IdUsuario' => $user->id,
             
            ]);
    
            // LLAMAR EL METODO STORE DEL CONTROLADOR DE RESERVAS
            $response = (new UserIncidenteController)->store($request);
    
            // VERIFICAR QUE SE HA REALIZADO
            // CAMBIAR EL NUMERO A 1 DESPUES DE ELIMINAR TODOS LOS INCIDENTES O PONER EL NUMERO DE INCIDENTES QUE HABRÁN LUEGO DE EJECUTAR ESTA PRUEBA
            $this->assertCount(1, Incidentes::all());
     

          
 
    }

}
