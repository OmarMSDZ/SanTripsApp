<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tipo_servicio')->constrained('tipos');
            $table->string('nombre', 50);
            $table->string('telefono', 50);
            $table->string('email', 50);
            $table->string('id_pais', 50)->nullable();
            $table->string('id_provincia', 50)->nullable();
            $table->string('id_ciudad', 50)->nullable();
            $table->string('direccion', 50)->nullable();
            $table->foreignId('creado_por')->constrained('users');
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
