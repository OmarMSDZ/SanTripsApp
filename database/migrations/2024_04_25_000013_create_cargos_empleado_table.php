<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('cargos_empleado', function (Blueprint $table) {
 
            $table->id('IdCargo');
            $table->string('Cargo', 50);
            $table->float('Sueldo');
            $table->text('Responsabilidades');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('cargos_empleado');
    }
};
