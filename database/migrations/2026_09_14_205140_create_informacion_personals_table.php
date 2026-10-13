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
        Schema::create('informacion_personal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->unique()->constrained('trabajadors');
            $table->foreignId('estado_civil_id')->constrained('estado_civils');
            $table->string('nombre_conyuge',100)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('telefono',20)->nullable();
            $table->string('correo',100)->nullable();
            $table->boolean('licencia_conducir')->default(false);
            $table->string('tipo_licencia',50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_personal');
    }
};
