<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('empresas_proveedoras', function (Blueprint $table) {

            $table->id('IdEmpresasprov');
            $table->string('Nombre', 50);
            $table->string('Telefono', 15);
            $table->string('Email', 50);
            $table->string('Direccion', 75);
 
        });
    }


    public function down()
    {
        Schema::dropIfExists('empresas_proveedoras');
    }
};
