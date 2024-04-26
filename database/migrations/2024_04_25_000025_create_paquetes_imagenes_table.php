<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('Paquetes_imagenes', function (Blueprint $table) {
        
            $table->increments('Id');
            $table->unsignedInteger('fk_IdPaquete');
            $table->unsignedInteger('fk_IdImgPaquete');

            $table->index(["fk_IdPaquete"], 'fk_IdPaquete');

            $table->index(["fk_IdImgPaquete"], 'fk_IdImgPaquete');


            $table->foreign('fk_IdImgPaquete', 'fk_IdImgPaquete')
                ->references('IdImgPaquete')->on('imagenes_paquetes')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdPaquete', 'fk_IdPaqueteImagen')
                ->references('IdPaquete')->on('paquetes_turisticos')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('Paquetes_imagenes');
    }
};
