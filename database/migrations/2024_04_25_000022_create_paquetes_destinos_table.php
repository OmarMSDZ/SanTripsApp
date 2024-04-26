<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('Paquetes_destinos', function (Blueprint $table) {
          
            $table->increments('Id');
            $table->unsignedInteger('fk_IdPaquete');
            $table->unsignedInteger('fk_IdDestino');

            $table->index(["fk_IdPaquete"], 'fk_IdPaquete');

            $table->index(["fk_IdDestino"], 'fk_IdDestino');


            $table->foreign('fk_IdDestino', 'fk_IdDestino')
                ->references('IdDestino')->on('destinos')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdPaquete', 'fk_IdPaquete')
                ->references('IdPaquete')->on('paquetes_turisticos')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('Paquetes_destinos');
    }
};
