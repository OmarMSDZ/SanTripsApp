<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('detalle_pago', function (Blueprint $table) {
          
            $table->id('IdDetallePago');
            $table->foreignId('fk_NumFactura')->constrained('factura', 'NumFactura');
            $table->foreignId('fk_IdPago')->constrained('pago', 'IdPago');
            $table->timestamps();
            
           
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('detalle_pago');
    }
};
