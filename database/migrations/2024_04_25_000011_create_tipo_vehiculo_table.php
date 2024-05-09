<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('Tipo_vehiculo', function (Blueprint $table) {
          
            $table->id('IdTipoVehiculo');
            $table->string('TipoVehiculo', 25);
            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('Tipo_vehiculo');
    }
};
