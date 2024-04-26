<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('Provincias', function (Blueprint $table) {
          
            $table->increments('IdProvincia');
            $table->string('Provincia', 25);
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('Provincias');
    }
};
