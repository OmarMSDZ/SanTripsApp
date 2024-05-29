<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('paquetes_turisticos', function (Blueprint $table) {

            $table->id();
            $table->string('Nombre', 50);
            $table->text('Descripcion');
            $table->float('Costo');
            $table->integer('Num_personas');
            $table->string('Edades', 15);
            $table->string('Idiomas', 50);
            $table->string('Alojamiento', 50)->nullable()->default(null);
            $table->integer('Tiempo_estimado');
            $table->string('Disponibilidad', 25)->default('DISPONIBLE');
            
            $table->time('Horainicio');
            $table->text('PuntoEncuentro')->nullable();
            
            
            $table->string('imagen1', 255)->nullable();
            $table->string('imagen2', 255)->nullable();
            $table->string('imagen3', 255)->nullable();
            
            $table->string('Estado', 25)->default('ACTIVO');
            
            // $table->foreignId('fk_IdCategoriapaq')->nullable()->constrained('categorias_paquetes', 'IdCategoriapaq');
            $table->foreignId('id_categoria_paquete')->nullable()->constrained('tipos');
            $table->foreignId('fk_IdOferta')->nullable()->constrained('ofertas', 'IdOferta');

            
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('paquetes_turisticos');
    }
};
