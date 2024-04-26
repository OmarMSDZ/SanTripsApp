<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('Pago', function (Blueprint $table) {
         
            $table->increments('IdPago');
            $table->float('Monto');
            $table->dateTime('Fecha');
            $table->string('Num_referencia', 15);
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('Pago');
    }
};
