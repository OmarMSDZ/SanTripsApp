<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
      
    public function up()
    {
        Schema::create('tipo_serviciosproveedor', function (Blueprint $table) {
            $table->increments('IdTipoServicio');
            $table->string('TipoServicio', 50);
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('tipo_serviciosproveedor');
    }
};
