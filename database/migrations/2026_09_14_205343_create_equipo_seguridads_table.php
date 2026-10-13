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
        Schema::create('equipos_seguridad', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_epp',25);
            $table->string('talla_zapatos',5);
            $table->string('talla_overol',5);
            $table->string('talla_camisa',5);
            $table->string('talla_pantalon',5);
            $table->string('talla_chaleco',5);
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_seguridad');
    }
};
