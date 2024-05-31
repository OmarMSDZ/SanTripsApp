<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RutasTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testInicioPageRoute()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    
    public function testReservaRoute()
    {
        $response = $this->get('usuario/paquetes');
        $response->assertStatus(200);
    }

    public function testPoliticasRoute()
    {
        $response = $this->get('/politicas');
        $response->assertStatus(200);
    }

    




}
