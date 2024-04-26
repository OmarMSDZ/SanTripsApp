<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('Empresas_proveedoras', function (Blueprint $table) {
           
            $table->increments('IdEmpresasprov');
            $table->string('Nombre', 50);
            $table->string('Telefono', 15);
            $table->string('Email', 50);
            $table->string('Direccion', 75);
            $table->unsignedInteger('fk_IdTipoServicio');
            $table->unsignedInteger('fk_IdProvincia');

            $table->index(["fk_IdTipoServicio"], 'fk_IdTipoServicio');

            $table->index(["fk_IdProvincia"], 'fk_IdProvincia');


            $table->foreign('fk_IdProvincia', 'fk_IdProvinciaEmpProv')
                ->references('IdProvincia')->on('provincias')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdTipoServicio', 'fk_IdTipoServicioEmpProv')
                ->references('IdTipoServicio')->on('tipo_serviciosproveedor')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('Empresas_proveedoras');
    }
};
