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
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->id();
            $table->string('nt', 15)->unique();
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100)->nullable();
            $table->enum('sexo', ['hombre', 'mujer']);
            $table->string('nss', 20)->nullable();
            $table->string('curp', 18)->unique();
            $table->string('rfc', 13)->nullable();
            $table->date('fecha_nacimiento');
            $table->foreignId('lugar_nacimiento_id')->references('id')->on('lugar_nacimientos');
            $table->foreignId('tipo_sangre_id')->references('id')->on('tipo_sangres');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadors');
    }
};
