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
  
            $table->increments('IdVehiculo');
            $table->text('Descripcion');
            $table->string('Matricula', 15);
            $table->date('FechaIngreso');
            $table->integer('CantidadPasajeros');
            $table->integer('A�oVehiculo');
            $table->string('Color', 15);
            $table->string('TipoCombustible', 20);
            $table->unsignedInteger('fk_IdTipoVehiculo');
            $table->unsignedInteger('fk_IdMarcaVehiculo');
            $table->unsignedInteger('fk_IdModeloVehiculo');

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
