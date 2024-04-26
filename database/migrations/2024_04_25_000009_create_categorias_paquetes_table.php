<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('Categorias_paquetes', function (Blueprint $table) {
        
            $table->increments('IdCategoriapaq');
            $table->string('Categoriapaq', 50);
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('Categorias_paquetes');
    }
};
