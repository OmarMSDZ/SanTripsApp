<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('detalle_reserva', function (Blueprint $table) {

            $table->id('IdDetalleReserva');
            $table->integer('cantidad');
            $table->foreignId('id_paquete_turistico')->constrained('paquetes_turisticos');
            $table->foreignId('fk_IdReservacion')->constrained('reservacion', 'IdReservacion');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('detalle_reserva');
    }
};
