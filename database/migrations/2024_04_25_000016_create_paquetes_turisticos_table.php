<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('Paquetes_turisticos', function (Blueprint $table) {
          
            $table->id('IdPaquete');
            $table->string('Nombre', 50);
            $table->text('Descripcion');
            $table->float('Costo');
            $table->integer('Num_personas');
            $table->string('Edades', 15);
            $table->string('Idiomas', 50);
            $table->string('Alojamiento', 50)->nullable()->default(null);
            $table->integer('Tiempo_estimado');
            $table->string('Disponibilidad', 25);
            $table->unsignedBigInteger('fk_IdCategoriapaq');
            $table->unsignedBigInteger('fk_IdOferta');
            $table->timestamps();

            $table->index(["fk_IdCategoriapaq"], 'fk_IdCategoriapaq');

            $table->index(["fk_IdOferta"], 'fk_IdOferta');


            $table->foreign('fk_IdCategoriapaq', 'fk_IdCategoriapaq')
                ->references('IdCategoriapaq')->on('categorias_paquetes')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdOferta', 'fk_IdOferta')
                ->references('IdOferta')->on('ofertas')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('Paquetes_turisticos');
    }
};
