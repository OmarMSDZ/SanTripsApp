<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('provincias', function (Blueprint $table) {
            // $table->id('IdProvincia');
            // $table->string('Provincia', 25);
            $table->id();
            $table->foreignId('id_pais')->constrained('paises');
            $table->integer('id_provincia_api')->nullable()->unique();
            $table->string('iso2_api', 5)->nullable();
            $table->string('nombre', 100);
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('provincias');
    }
};
