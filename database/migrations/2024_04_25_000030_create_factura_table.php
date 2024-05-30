<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('Factura', function (Blueprint $table) {
           
            $table->id('NumFactura');
            $table->dateTime('Fecha');
            $table->text('Descripcion')->nullable()->default(null);
            $table->float('Monto');
            $table->float('Impuestos')->nullable()->default(null);
            $table->float('Descuentos')->nullable()->default(null);
            $table->string('Tipo_pago', 50);
            $table->string('Plazo', 25)->nullable()->default(null);
            $table->float('Monto_pendiente')->nullable()->default(null);
            $table->foreignId('fk_IdReservacion')->constrained('Reservacion', 'IdReservacion');
            
            $table->timestamps();
            
          
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('Factura');
    }
};
