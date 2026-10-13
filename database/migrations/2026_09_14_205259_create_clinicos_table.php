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
        Schema::create('clinicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->references('id')->on('trabajadors');
            $table->string('tipo_examen', 100);
            $table->date('fecha_evaluacion');
            $table->decimal('peso',8,2);
            $table->decimal('talla',5,2);
            $table->decimal('imc',5,2);
            $table->string('tas',50);
            $table->string('tad',50);
            $table->decimal('glucosa',8,2);
            $table->decimal('colesterol',8,2);
            $table->decimal('trigliceridos',8,2);
            $table->decimal('urea',8,2);
            $table->decimal('hemoglobina',8,2);
            $table->boolean('usa_lentes');
            $table->boolean('disminucion_visual');
            $table->boolean('alergias');
            $table->string('tipo_alergias',50)->nullable();
            $table->string('caso_especial',100)->nullable();
            $table->boolean('descripcion_caso');
            $table->boolean('apto_ta');
            $table->boolean('apto_er');
            $table->boolean('apto_ec');
            $table->boolean('apto_cm');
            $table->boolean('apto_v');
            $table->boolean('apto_cs');
            $table->text('radiografia')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinicos');
    }
};
