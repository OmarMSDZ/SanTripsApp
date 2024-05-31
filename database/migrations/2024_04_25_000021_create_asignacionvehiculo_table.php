<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('asignacion_vehiculo', function (Blueprint $table) {

            $table->id('IdAsignacion');
            $table->date('FechaAsignacion');
            $table->foreignId('id_empleado')->constrained('empleados');
            $table->foreignId('fk_IdVehiculo')->constrained('vehiculo_transporte', 'IdVehiculo');
            
            
            $table->timestamps();

     
        });
    }


    public function down()
    {
        Schema::dropIfExists('asignacion_vehiculo');
    }
};
