<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('destinos', function (Blueprint $table) {

            $table->id();
            $table->foreignId('id_tipo_destino')->nullable()->constrained('tipos');
            $table->foreignId('id_proveedor')->constrained('proveedores');
            $table->string('nombre', 100);
            $table->time('hora_desde');
            $table->time('hora_hasta');
            $table->text('observaciones')->nullable();
            $table->foreignId('id_pais')->nullable()->constrained('paises');
            $table->foreignId('id_provincia')->nullable()->constrained('provincias');
            $table->foreignId('id_ciudad')->nullable()->constrained('ciudades');
            $table->foreignId('creado_por')->constrained('users');
            $table->foreignId('actualizado_por')->nullable()->constrained('users');
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });

    }


    public function down()
    {
        Schema::dropIfExists('destinos');
    }
};
