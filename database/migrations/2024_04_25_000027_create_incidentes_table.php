<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('Incidentes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('IdIncidente');
            $table->dateTime('FechaIncidente');
            $table->text('Descripcion');
            $table->unsignedBigInteger('fk_IdTipoIncidente');
            $table->unsignedBigInteger('fk_IdUsuario');
            $table->timestamps();
            
            $table->index(["fk_IdTipoIncidente"], 'fk_IdTipoIncidente');

            $table->index(["fk_IdUsuario"], 'fk_IdUsuario');


            $table->foreign('fk_IdTipoIncidente', 'fk_IdTipoIncidente')
                ->references('IdTipoIncidente')->on('tipo_incidente')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdUsuario', 'fk_IdUsuarioIncidente')
                ->references('IdUsuario')->on('usuarios')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('Incidentes');
    }
};
