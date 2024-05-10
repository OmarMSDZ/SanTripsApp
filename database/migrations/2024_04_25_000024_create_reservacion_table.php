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
            $table->string('EstadoReservacion')->default('ACTIVA');
            
            $table->unsignedBigInteger('fk_IdMetodopago');
            $table->unsignedBigInteger('fk_IdUsuario');
    
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
