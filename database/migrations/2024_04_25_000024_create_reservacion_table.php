<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('reservacion', function (Blueprint $table) {
        
            $table->id('IdReservacion');
            $table->date('FechaSeleccionada');
    
            $table->text('Detalles_adicionales')->nullable()->default(null);
            $table->float('MontoTotal')->nullable()->default(null);
            $table->integer('CantidadPersonas')->default('1');
            //esto porque la reservacion se va a crear primero que el pago
            $table->string('EstadoReservacion')->default('PAGO PENDIENTE');
            
          
            $table->foreignId('fk_IdMetodopago')->constrained('metodo_pago', 'IdMetodopago');
            $table->foreignId('fk_IdUsuario')->constrained('users');
            
            //fecha de expiracion de la reserva (se le dara una hora o 2)
            $table->timestamp('fecha_expiracion');
    
            $table->timestamps();
        
          
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('reservacion');
    }
};
