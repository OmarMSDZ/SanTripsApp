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
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_tipo_aplicacion')->constrained('tipos')->comment('Hace referencia al ID de la tabla tipos');
            $table->foreignId('id_app_padre')->nullable()->constrained('apps')->comment('Hace referencia al ID de la tabla tipos');
            $table->string('codigo')->nullable();
            $table->boolean('modulo')->default(0);
            $table->string('nombre', 100);
            $table->string('icono', 50)->nullable()->default('bi bi-app');
            $table->string('description')->nullable();
            $table->string('ruta')->nullable();
            $table->integer('orden')->default(1);
            $table->integer('nueva')->default(0);
            $table->integer('actualizada')->default(0);
            $table->boolean('activo')->default(1);
            $table->boolean('visible')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};
