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
        Schema::create('historial_trabajadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->references('id')->on('trabajadors');
            $table->foreignId('departamento_id')->references('id')->on('departamentos');
            $table->foreignId('obra_id')->references('id')->on('obras');
            $table->foreignId('puesto_id')->references('id')->on('puestos');
            $table->foreignId('gerencia_id')->references('id')->on('gerencias');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->decimal('salario_base',10,2);
            $table->decimal('salario_diario',10,2);
            $table->string('registro_patronal',100);
            $table->boolean('activo');
            $table->string('correo_laboral',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_trabajadores');
    }
};
