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
        Schema::create('dependientes_familiares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->constrained('trabajadors');
            $table->foreignId('parentesco_id')->constrained('parentescos');
            $table->string('nombre',100);
            $table->string('apellido_paterno',100);
            $table->string('apellido_materno',100)->nullable();
            $table->enum('sexo',['hombre','mujer']);
            $table->string('curp',18);
            $table->boolean('es_beneficiario')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependientes_familiares');
    }
};
