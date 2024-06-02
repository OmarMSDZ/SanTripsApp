<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Mockery;
use App\Models\Reservacion;
use App\Models\Detalle_reserva;

class ReservacionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use WithFaker;

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_store_reservation_successfully()
    {
        // Prepara los datos de prueba
        $data = [
            'paquete_id' => 1,
            'usuario_id' => 1,
            'FechaSeleccionada' => now()->addDays(1)->format('Y-m-d'),
            'CantidadPersonas' => 2,
            'MontoTotal' => 200.00,
            'MetodoPago' => 'credit_card',
        ];

        // Mock del Request
        $requestMock = Mockery::mock('alias:Illuminate\Http\Request');
        $requestMock->shouldReceive('validate')
            ->once()
            ->andReturn($data);
        $requestMock->shouldReceive('input')
            ->andReturnUsing(function ($key) use ($data) {
                return $data[$key];
            });

        // Mock del modelo Reservacion
        $reservacionMock = Mockery::mock('alias:App\Models\Reservacion');
        $reservacionMock->shouldReceive('create')
            ->once()
            ->andReturn((object)[
                'IdReservacion' => 1,
            ]);

        // Mock del modelo Detalle_reserva
        $detalleReservaMock = Mockery::mock('alias:App\Models\Detalle_reserva');
        $detalleReservaMock->shouldReceive('create')
            ->once()
            ->andReturn(true);

        // Ejecuta la solicitud POST
        $response = $this->post(route('reservas.store'), $data);

        // Verifica la redirección y el mensaje de éxito
        $response->assertRedirect(route('reservas_realizadas'));
        $response->assertSessionHas('warning', 'Se ha Realizado con exito su reserva!, expirará dentro de 1 hora en caso de no proceder con el pago');
    }
}
