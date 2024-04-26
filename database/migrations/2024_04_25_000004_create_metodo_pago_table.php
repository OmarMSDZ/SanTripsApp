<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
     
    public function up()
    {
        Schema::create('Metodo_pago', function (Blueprint $table) {
        
            $table->increments('IdMetodopago');
            $table->string('Metodo_Pago', 50);
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('Metodo_pago');
    }
};
