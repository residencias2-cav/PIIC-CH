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
        Schema::create('fallas_equipo_electronico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_electronico_id')->constrained('equipos_electronicos');
            $table->string('falla',50);
            $table->text('descripcion');
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fallas_equipo_electronico');
    }
};
