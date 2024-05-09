<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('Detalle_reserva', function (Blueprint $table) {
          
            $table->id('IdDetalleReserva');
            $table->integer('cantidad');
            $table->unsignedBigInteger('fk_IdPaquete');
            $table->unsignedBigInteger('fk_IdReservacion');
            $table->timestamps();
            
            $table->index(["fk_IdPaquete"], 'fk_IdPaquete');

            $table->index(["fk_IdReservacion"], 'fk_IdReservacion');


            $table->foreign('fk_IdPaquete', 'fk_IdPaqueteDetalleReserva')
                ->references('IdPaquete')->on('paquetes_turisticos')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdReservacion', 'fk_IdReservacionDetalleReserva')
                ->references('IdReservacion')->on('reservacion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('Detalle_reserva');
    }
};
