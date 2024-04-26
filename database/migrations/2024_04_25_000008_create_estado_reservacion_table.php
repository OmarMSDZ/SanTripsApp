<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('Estado_reservacion', function (Blueprint $table) {
        
            $table->increments('IdEstadoReservacion');
            $table->string('EstadoReservacion', 15);
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('Estado_reservacion');
    }
};
