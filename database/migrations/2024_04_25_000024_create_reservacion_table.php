<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('Reservacion', function (Blueprint $table) {
        
            $table->id('IdReservacion');
            $table->date('FechaSeleccionada');
    
            $table->text('Detalles_adicionales')->nullable()->default(null);
            $table->float('MontoTotal')->nullable()->default(null);
            $table->integer('CantidadPersonas')->default('1');
            //esto porque la reservacion se va a crear primero que el pago
            $table->string('EstadoReservacion')->default('PAGO PENDIENTE');
            
            $table->unsignedBigInteger('fk_IdMetodopago');
            $table->unsignedBigInteger('fk_IdUsuario');
            //fecha de expiracion de la reserva (se le dara una hora o 2)
            $table->timestamp('fecha_expiracion');
    
            $table->timestamps();
            
            $table->index(["fk_IdMetodopago"], 'fk_IdMetodopago');

            $table->index(["fk_IdUsuario"], 'fk_IdUsuario');

          
     

            $table->foreign('fk_IdMetodopago', 'fk_IdMetodopago')
                ->references('IdMetodopago')->on('metodo_pago')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdUsuario', 'fk_IdUsuario')
                ->references('IdUsuario')->on('usuarios')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('Reservacion');
    }
};
