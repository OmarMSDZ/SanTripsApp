<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
           
            $table->id('NumFactura');
            $table->dateTime('Fecha');
            $table->text('Descripcion')->nullable()->default(null);
            $table->float('Monto');
     
            $table->float('Descuentos')->nullable()->default(null);
 
  
            $table->float('Monto_pendiente')->nullable()->default(null);
            $table->foreignId('fk_IdReservacion')->constrained('reservacion', 'IdReservacion');
            
            $table->timestamps();
            
          
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('factura');
    }
};
