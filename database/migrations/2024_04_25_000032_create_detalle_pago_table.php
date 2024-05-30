<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('Detalle_pago', function (Blueprint $table) {
          
            $table->id('IdDetallePago');
            $table->foreignId('fk_NumFactura')->constrained('Factura', 'NumFactura');
            $table->foreignId('fk_IdPago')->constrained('Pago', 'IdPago');
            $table->timestamps();
            
           
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('Detalle_pago');
    }
};
