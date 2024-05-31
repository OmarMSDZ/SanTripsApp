<?php 

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RendimientoTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Probar el rendimiento de la ruta de inicio
     *
     * @return void
     */
    public function testPaginaPrincipalRendimiento()
    {
        $startTime = microtime(true);

        $response = $this->get(route('inicio'));

        $response->assertStatus(200);

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        // revisa si el tiempo de carga es menor de 2 segundos (2000 milliseconds)
        $this->assertLessThan(2, $executionTime, "La pagina principal cargó lo suficientemente rapido");
       
    }
}