<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
     
    public function up()
    {
        Schema::create('Usuarios', function (Blueprint $table) {
          
            $table->increments('IdUsuario');
            $table->string('Nombres', 50);
            $table->string('Apellidos', 50);
            $table->string('Nombre_usuario', 50);
            $table->string('Telefono', 15);
            $table->string('Email', 50);
            $table->string('Contrasena', 50);
            $table->string('TipoUsuario', 25);
            $table->unsignedInteger('fk_IdPreferenciaViaje');

            $table->index(["fk_IdPreferenciaViaje"], 'fk_IdPreferenciaViaje');


            $table->foreign('fk_IdPreferenciaViaje', 'fk_IdPreferenciaViaje')
                ->references('IdPreferenciaViaje')->on('preferencias_viaje')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('Usuarios');
    }
};
