<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
     
    public function up()
    {
        Schema::create('metodo_pago', function (Blueprint $table) {
        
            $table->id('IdMetodopago');
            $table->string('Metodo_Pago', 50);
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('metodo_pago');
    }
};
