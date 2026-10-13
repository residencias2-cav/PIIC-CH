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
        Schema::create('equipos_electronicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained('obras');
            $table->string('act_ina',15);
            $table->string('marca',20);
            $table->string('modelo',30);
            $table->string('no_serie',50);
            $table->string('procesador',50);
            $table->string('color',15);
            $table->string('hd',15);
            $table->string('ram',15);
            $table->string('os',50);
            $table->date('fecha_alta');
            $table->string('foto',300)->nullable();
            $table->string('robo_ext',10)->nullable();
            $table->string('funcionalidad',15);
            $table->decimal('costos',10,0);
            $table->string('tipo_dispositivo',50);
            $table->string('estatus',15);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_electronicos');
    }
};
