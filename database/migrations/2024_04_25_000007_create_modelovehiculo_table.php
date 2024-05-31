<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('modelo_vehiculo', function (Blueprint $table) {
            
            $table->id('IdModeloVehiculo');
            $table->string('ModeloVehiculo', 25);
            $table->foreignId('fk_IdMarcaVehiculo')->nullable()->constrained('marca_vehiculo','IdMarcaVehiculo');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('modelo_vehiculo');
    }
};
