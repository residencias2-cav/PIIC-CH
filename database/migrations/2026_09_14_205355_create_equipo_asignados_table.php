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
        Schema::create('equipos_asignados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_electronico_id')->constrained('equipos_electronicos');
            $table->foreignId('trabajador_id')->constrained('trabajadors');
            $table->date('fecha_alta');
            $table->date('fecha_baja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_asignados');
    }
};
