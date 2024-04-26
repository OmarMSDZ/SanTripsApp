<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('Vehiculos_paquetes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('IdVehiculosPaquetes');
            $table->unsignedInteger('fk_IdVehiculo');
            $table->unsignedInteger('fk_IdPaquete');

            $table->index(["fk_IdVehiculo"], 'fk_IdVehiculo');

            $table->index(["fk_IdPaquete"], 'fk_IdPaquete');


            $table->foreign('fk_IdPaquete', 'fk_IdPaqueteVehiculo')
                ->references('IdPaquete')->on('paquetes_turisticos')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdVehiculo', 'fk_IdVehiculoPaquete')
                ->references('IdVehiculo')->on('vehiculo_transporte')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('Vehiculos_paquetes');
    }
};
