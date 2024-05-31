<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('encargados_paquetes', function (Blueprint $table) {

            $table->id('IdEncargadosPaquetes');
            $table->date('Fecha');
            $table->foreignId('id_paquete_turistico')->constrained('paquetes_turisticos');

   
            $table->foreignId('id_empleado')->constrained('empleados');

       
            $table->timestamps();
 
        });
    }

    public function down()
    {
        Schema::dropIfExists('encargados_paquetes');
    }
};
