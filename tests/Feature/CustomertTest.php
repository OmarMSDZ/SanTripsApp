<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomertTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_store(): void {

        $response = $this->post(route('proveedores.store'), [
            'nombre' => 'TEST121',
            'telefono' => '453415',
            'email' => 'fasdf@fa3sd.com',
            'tiposervicio' => 12,
            'pais' => 3,
            'provincia' => 23,
            'direccion' => '35435',
            'estado' => 'ACTIVO'
        ]);


        $response->assertRedirect(route('proveedores.index'));
    }
}
