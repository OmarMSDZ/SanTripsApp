<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('estado_reservacion', function (Blueprint $table) {
        
            $table->id('IdEstadoReservacion');
            $table->string('EstadoReservacion', 15);
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('estado_reservacion');
    }
};
