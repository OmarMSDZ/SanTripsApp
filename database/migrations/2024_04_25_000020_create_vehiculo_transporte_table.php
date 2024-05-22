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
            
            $table->string('Matricula', 15)->unique();
            
            $table->date('FechaIngreso');
            
            $table->integer('CantidadPasajeros');
            
            $table->integer('AnoVehiculo');
            
            $table->string('Color', 15);
            
            $table->string('TipoCombustible', 20);
            
            $table->foreignId('fk_IdTipoVehiculo')->nullable()->constrained('tipos');;
            
            $table->foreignId('fk_IdMarcaVehiculo')->nullable()->constrained('Marca_vehiculo', 'IdMarcaVehiculo');
            
            $table->foreignId('fk_IdModeloVehiculo')->nullable()->constrained('Modelo_vehiculo', 'IdModeloVehiculo');

            $table->string('Estado', 25)->default('ACTIVO');
            
            $table->timestamps();
            
           
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('Vehiculo_transporte');
    }
};
