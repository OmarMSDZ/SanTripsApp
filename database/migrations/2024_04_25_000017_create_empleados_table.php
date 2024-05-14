<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('Empleados', function (Blueprint $table) {

            $table->id();
            $table->string('Cedula', 13);
            $table->string('Nombres', 50);
            $table->string('Apellidos', 50);
            $table->string('Telefono', 15);
            $table->string('Email', 50);
            $table->dateTime('Fecha_ingreso');
            $table->dateTime('Fecha_salida')->nullable()->default(null);
            $table->string('Estado', 15);
            $table->string('LicenciaConducir', 20)->nullable()->default(null);
            $table->foreignId('id_cargo')->nullable()->constrained('cargos_empleado', 'IdCargo');
            $table->timestamps();
            // $table->unsignedBigInteger('fk_IdCargo');

            // $table->index(["fk_IdCargo"], 'fk_IdCargo');


            // $table->foreign('fk_IdCargo', 'fk_IdCargo')
            //     ->references('IdCargo')->on('cargos_empleado')
            //     ->onDelete('restrict')
            //     ->onUpdate('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('Empleados');
    }
};
