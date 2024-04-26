<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('Tipo_destino', function (Blueprint $table) {
        
            $table->increments('IdTipoDestino');
            $table->string('TipoDestino', 25);
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('Tipo_destino');
    }
};
