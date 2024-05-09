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
            $table->date('FechaDesde');
            $table->date('FechaHasta');
            $table->text('Detalles_adicionales')->nullable()->default(null);
            $table->float('MontoTotal')->nullable()->default(null);
            $table->integer('CantidadPersonas')->default('1');
            $table->unsignedBigInteger('fk_IdMetodopago');
            $table->unsignedBigInteger('fk_IdUsuario');
            $table->unsignedBigInteger('fk_IdEstadoReservacion');
            $table->timestamps();
            
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
