<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('Encargados_paquetes', function (Blueprint $table) {

            $table->id('IdEncargadosPaquetes');
            $table->date('Fecha');
            $table->foreignId('id_paquete_turistico')->constrained('paquetes_turisticos');

            // $table->unsignedBigInteger('fk_IdPaquete');
            $table->foreignId('id_empleado')->constrained('Empleados');

            // $table->unsignedBigInteger('fk_IdEmpleado');
            $table->timestamps();

            // $table->index(["fk_IdPaquete"], 'fk_IdPaquete');

            // $table->index(["fk_IdEmpleado"], 'fk_IdEmpleado');


            // $table->foreign('fk_IdEmpleado', 'fk_IdEmpleadoEncargado')
            //     ->references('IdEmpleado')->on('empleados')
            //     ->onDelete('restrict')
            //     ->onUpdate('cascade');

            // $table->foreign('fk_IdPaquete', 'fk_IdPaqueteEncargado')
            //     ->references('IdPaquete')->on('paquetes_turisticos')
            //     ->onDelete('restrict')
            //     ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Encargados_paquetes');
    }
};
