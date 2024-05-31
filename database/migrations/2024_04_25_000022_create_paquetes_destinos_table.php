<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('paquetes_destinos', function (Blueprint $table) {

            $table->id();
            $table->foreignId('id_paquetes_turistico')->constrained('paquetes_turisticos');
            $table->foreignId('id_destino')->constrained('destinos');

    
            $table->timestamps();

 
        });
    }


    public function down()
    {
        Schema::dropIfExists('paquetes_destinos');
    }
};
