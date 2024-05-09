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
            $table->unsignedBigInteger('fk_IdReservacion');
            $table->timestamps();
            
            $table->index(["fk_IdReservacion"], 'fk_IdReservacion');


            $table->foreign('fk_IdReservacion', 'fk_IdReservacionFactura')
                ->references('IdReservacion')->on('reservacion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('Factura');
    }
};
