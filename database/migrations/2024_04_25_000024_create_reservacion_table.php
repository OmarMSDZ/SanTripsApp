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
        
            $table->increments('IdReservacion');
            $table->date('FechaDesde');
            $table->date('FechaHasta');
            $table->text('Detalles_adicionales')->nullable()->default(null);
            $table->float('MontoTotal')->nullable()->default(null);
            $table->unsignedInteger('fk_IdMetodopago');
            $table->unsignedInteger('fk_IdUsuario');
            $table->unsignedInteger('fk_IdEstadoReservacion');

            $table->index(["fk_IdMetodopago"], 'fk_IdMetodopago');

            $table->index(["fk_IdUsuario"], 'fk_IdUsuario');

            $table->index(["fk_IdEstadoReservacion"], 'fk_IdEstadoReservacion');


            $table->foreign('fk_IdEstadoReservacion', 'fk_IdEstadoReservacion')
                ->references('IdEstadoReservacion')->on('estado_reservacion')
                ->onDelete('restrict')
                ->onUpdate('cascade');

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
