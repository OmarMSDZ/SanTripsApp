<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('vehiculos_paquetes', function (Blueprint $table) {
            // $table->engine = 'InnoDB';
            $table->id('IdVehiculosPaquetes');
            $table->foreignId('id_paquete_turistico')->constrained('paquetes_turisticos');
            $table->foreignId('fk_IdVehiculo')->constrained('vehiculo_transporte', 'IdVehiculo');
            
            // $table->unsignedBigInteger('fk_IdPaquete');
            $table->timestamps();

        });
    }


    public function down()
    {
        Schema::dropIfExists('vehiculos_paquetes');
    }
};
