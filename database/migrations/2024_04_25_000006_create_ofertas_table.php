<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
      
            $table->id('IdOferta');
            $table->text('Descripcion');
            $table->integer('Porcentaje');
            $table->date('FechaDesde');
            $table->date('FechaHasta');
            $table->foreignId('creado_por')->constrained('users');
            $table->foreignId('actualizado_por')->nullable()->constrained('users');

            $table->string('estado')->default('ACTIVO');
            
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
};
