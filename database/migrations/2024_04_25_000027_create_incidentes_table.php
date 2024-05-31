<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('incidentes', function (Blueprint $table) {
            
            $table->id('IdIncidente');
            $table->dateTime('FechaIncidente');
            $table->text('Descripcion');
            $table->string('Estado', 25)->default('ACTIVO');
            $table->foreignId('fk_IdTipoIncidente')->constrained('tipos');
            $table->foreignId('fk_IdUsuario')->constrained('users');
            $table->timestamps();

        });
    }

 
    public function down()
    {
        Schema::dropIfExists('incidentes');
    }
};
