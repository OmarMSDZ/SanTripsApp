<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('Ticket_electronico', function (Blueprint $table) {
           
            $table->increments('Id');
            $table->dateTime('Fecha');
            $table->dateTime('Valido_hasta');
            $table->text('Punto_encuentro');
            $table->unsignedInteger('fk_IdReservacion');
            $table->unsignedInteger('fk_IdEmpleado');
            $table->unsignedInteger('fk_IdUsuario');

            $table->index(["fk_IdReservacion"], 'fk_IdReservacion');

            $table->index(["fk_IdEmpleado"], 'fk_IdEmpleado');

            $table->index(["fk_IdUsuario"], 'fk_IdUsuario');


            $table->foreign('fk_IdEmpleado', 'fk_IdEmpleadoTicket')
                ->references('IdEmpleado')->on('empleados')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdReservacion', 'fk_IdReservacionTicket')
                ->references('IdReservacion')->on('reservacion')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('fk_IdUsuario', 'fk_IdUsuarioTicket')
                ->references('IdUsuario')->on('usuarios')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('Ticket_electronico');
    }
};
