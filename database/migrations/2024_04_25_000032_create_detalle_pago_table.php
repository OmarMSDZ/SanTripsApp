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
            $table->unsignedBigInteger('fk_NumFactura');
            $table->unsignedBigInteger('fk_IdPago');
            $table->timestamps();
            
            $table->index(["fk_NumFactura"], 'fk_NumFactura');

            $table->index(["fk_IdPago"], 'fk_IdPago');


            $table->foreign('fk_NumFactura', 'fk_NumFacturaDetallePago')
                ->references('NumFactura')->on('factura')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdPago', 'fk_IdPagoDetallePago')
                ->references('IdPago')->on('pago')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('Detalle_pago');
    }
};
