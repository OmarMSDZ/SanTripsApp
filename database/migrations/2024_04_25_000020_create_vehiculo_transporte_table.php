<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('Vehiculo_transporte', function (Blueprint $table) {
  
            $table->id('IdVehiculo');
            $table->text('Descripcion');
            $table->string('Matricula', 15);
            $table->date('FechaIngreso');
            $table->integer('CantidadPasajeros');
            $table->integer('AnoVehiculo');
            $table->string('Color', 15);
            $table->string('TipoCombustible', 20);
            $table->unsignedBigInteger('fk_IdTipoVehiculo');
            $table->unsignedBigInteger('fk_IdMarcaVehiculo');
            $table->unsignedBigInteger('fk_IdModeloVehiculo');
            $table->timestamps();
            
            $table->index(["fk_IdTipoVehiculo"], 'fk_IdTipoVehiculo');

            $table->index(["fk_IdMarcaVehiculo"], 'fk_IdMarcaVehiculo');

            $table->index(["fk_IdModeloVehiculo"], 'fk_IdModeloVehiculo');


            $table->foreign('fk_IdMarcaVehiculo', 'fk_IdMarcaVehiculo')
                ->references('IdMarcaVehiculo')->on('marca_vehiculo')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdModeloVehiculo', 'fk_IdModeloVehiculo')
                ->references('IdModeloVehiculo')->on('Modelo_vehiculo')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdTipoVehiculo', 'fk_IdTipoVehiculo')
                ->references('IdTipoVehiculo')->on('tipo_vehiculo')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('Vehiculo_transporte');
    }
};
