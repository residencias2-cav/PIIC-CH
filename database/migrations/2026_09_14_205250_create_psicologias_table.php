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
        Schema::create('psicologias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->constrained('trabajadors');
            $table->string('inteligencia', 100);
            $table->string('niveles_da', 100);
            $table->string('personalidad', 100);
            $table->string('competencias', 100);
            $table->enum('niveles_dan', ['si', 'no']);
            $table->string('comportamiento', 50);
            $table->date('fecha_eval');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psicologias');
    }
};
