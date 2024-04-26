<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('Destinos', function (Blueprint $table) {
     
            $table->increments('IdDestino');
            $table->string('Destino', 50);
            $table->time('HorarioDesde');
            $table->time('HorarioHasta');
            $table->text('Observaciones');
            $table->unsignedInteger('fk_IdTipoDestino');
            $table->unsignedInteger('fk_IdProvincia');
        
            $table->index(["fk_IdTipoDestino"], 'fk_IdTipoDestino');
            $table->index(["fk_IdProvincia"], 'fk_IdProvincia');
        
            $table->foreign('fk_IdProvincia', 'fk_IdProvincia')
                ->references('IdProvincia')->on('provincias')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        
            $table->foreign('fk_IdTipoDestino', 'fk_IdTipoDestino')
                ->references('IdTipoDestino')->on('tipo_destino')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
        
    }

   
    public function down()
    {
        Schema::dropIfExists('Destinos');
    }
};
