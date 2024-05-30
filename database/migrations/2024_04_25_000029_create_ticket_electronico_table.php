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

            $table->id();
            $table->string('CodigoVerificacion');
            $table->dateTime('Fecha');
            $table->string('Codigo', 255)->unique();
            $table->dateTime('Valido_hasta');
            $table->text('Punto_encuentro');
            $table->foreignId('fk_IdReservacion')->constrained('Reservacion', 'IdReservacion');
            $table->foreignId('id_empleado')->constrained('Empleados');
            $table->foreignId('fk_IdUsuario')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Ticket_electronico');
    }
};
