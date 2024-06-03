<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


use App\Models\Payment;
use Mockery;
use Illuminate\Support\Facades\Config;


class PayPalTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // use RefreshDatabase;

    public function testCreateTransaction()
    {
        // Mocking the PayPalClient
        $paypalMock = Mockery::mock('overload:App\Services\PayPalClient');
        $paypalMock->shouldReceive('setApiCredentials')
            ->once()
            ->with(Config::get('paypal'))
            ->andReturnSelf();
        $paypalMock->shouldReceive('getAccessToken')
            ->once()
            ->andReturn('fake-token');
        $paypalMock->shouldReceive('setAccessToken')
            ->once()
            ->with('fake-token')
            ->andReturnSelf();
        $paypalMock->shouldReceive('createOrder')
            ->once()
            ->andReturn([
                'links' => [
                    1 => [
                        'href' => 'http://fake-url.com'
                    ]
                ]
            ]);

        $response = $this->get('/create-transaction');

        $response->assertRedirect('http://fake-url.com');
    }

    public function testCaptureTransaction()
    {
        // Mocking the PayPalClient
        $paypalMock = Mockery::mock('overload:App\Services\PayPalClient');
        $paypalMock->shouldReceive('setApiCredentials')
            ->once()
            ->with(Config::get('paypal'))
            ->andReturnSelf();
        $paypalMock->shouldReceive('getAccessToken')
            ->once()
            ->andReturn('fake-token');
        $paypalMock->shouldReceive('setAccessToken')
            ->once()
            ->with('fake-token')
            ->andReturnSelf();
        $paypalMock->shouldReceive('capturePaymentOrder')
            ->once()
            ->with('fake-order-id')
            ->andReturn([
                'status' => 'COMPLETED',
                'id' => 'fake-payment-id',
                'payer' => [
                    'payer_id' => 'fake-payer-id',
                    'email_address' => 'payer@example.com'
                ],
                'purchase_units' => [
                    0 => [
                        'payments' => [
                            'captures' => [
                                0 => [
                                    'amount' => [
                                        'value' => '100.00',
                                        'currency_code' => 'USD'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

        $response = $this->get('/capture-transaction?token=fake-order-id');

        $response->assertViewIs('payment_success');
        $this->assertDatabaseHas('payments', [
            'payment_id' => 'fake-payment-id',
            'payer_id' => 'fake-payer-id',
            'payer_email' => 'payer@example.com',
            'amount' => '100.00',
            'currency' => 'USD',
            'status' => 'COMPLETED',
        ]);
    }

    public function testCancelTransaction()
    {
        $response = $this->get('/cancel-transaction');

        $response->assertRedirect(route('inicio'));
        $response->assertSessionHas('error', 'Has cancelado tu transacción.');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
