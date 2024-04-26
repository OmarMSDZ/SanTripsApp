<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('Modelo_vehiculo', function (Blueprint $table) {
            
            $table->increments('IdModeloVehiculo');
            $table->string('ModeloVehiculo', 25);
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('Modelo_vehiculo');
    }
};
