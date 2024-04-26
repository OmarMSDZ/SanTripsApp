<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('Imagenes_paquetes', function (Blueprint $table) {
 
            $table->increments('IdImgPaquete');
            $table->binary('Imagen');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('Imagenes_paquetes');
    }
};
