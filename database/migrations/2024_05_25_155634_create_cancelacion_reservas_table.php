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
        Schema::create('cancelacion_reserva', function (Blueprint $table) {
            $table->id();
            $table->text('motivo');
            $table->string('acepta', 10);
            $table->foreignId('fk_IdReservacion')->constrained('reservacion', 'IdReservacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancelacion_reserva');
    }
};
