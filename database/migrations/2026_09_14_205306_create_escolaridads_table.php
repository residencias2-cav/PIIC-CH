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
        Schema::create('escolaridades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->references('id')->on('trabajadors');
            $table->string('escolaridad',100);
            $table->string('profesion',100);
            $table->string('doc_profecion',100);
            $table->string('matricula_cp',8);
            $table->enum('estudia',['si','no']);
            $table->string('estudia_algo',50)->nullable();
            $table->string('becas_escolares',100)->nullable();
            $table->string('grado_escolar',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escolaridades');
    }
};
