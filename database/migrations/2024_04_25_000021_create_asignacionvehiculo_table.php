<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('Asignacion_vehiculo', function (Blueprint $table) {
            
            $table->increments('IdAsignacion');
            $table->date('FechaAsignacion');
            $table->unsignedInteger('fk_IdEmpleado');
            $table->unsignedInteger('fk_IdVehiculo');

            $table->index(["fk_IdEmpleado"], 'fk_IdEmpleado');

            $table->index(["fk_IdVehiculo"], 'fk_IdVehiculo');


            $table->foreign('fk_IdEmpleado', 'fk_IdEmpleado')
                ->references('IdEmpleado')->on('empleados')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdVehiculo', 'fk_IdVehiculo')
                ->references('IdVehiculo')->on('vehiculo_transporte')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('Asignacion_vehiculo');
    }
};
