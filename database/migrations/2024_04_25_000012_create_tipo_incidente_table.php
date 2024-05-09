<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('Tipo_incidente', function (Blueprint $table) {
          
            $table->id('IdTipoIncidente');
            $table->string('TipoIncidente', 50);
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('Tipo_incidente');
    }
};
