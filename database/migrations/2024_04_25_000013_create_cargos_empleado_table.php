<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('Cargos_empleado', function (Blueprint $table) {
 
            $table->increments('IdCargo');
            $table->string('Cargo', 50);
            $table->float('Sueldo');
            $table->text('Responsabilidades');
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('Cargos_empleado');
    }
};
