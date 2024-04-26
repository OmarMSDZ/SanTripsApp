<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('Reservacion_personas', function (Blueprint $table) {
 
            $table->increments('Id');
            $table->string('Nombre', 50);
            $table->string('Cedula', 15);
            $table->string('Telefono', 12);
            $table->integer('Edad');
            $table->unsignedInteger('fk_IdReservacion');

            $table->index(["fk_IdReservacion"], 'fk_IdReservacion');


            $table->foreign('fk_IdReservacion', 'fk_IdReservacionPersonas')
                ->references('IdReservacion')->on('reservacion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('Reservacion_personas');
    }
};
