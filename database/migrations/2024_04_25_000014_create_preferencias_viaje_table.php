<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('Preferencias_viaje', function (Blueprint $table) {
     
            $table->id('IdPreferenciaViaje');
            $table->string('PreferenciaViaje', 50);
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('Preferencias_viaje');
    }
};
