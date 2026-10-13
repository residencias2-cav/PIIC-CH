<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->nullable()->unique()->constrained('trabajadors')->nullOnDelete();
            $table->foreignId('gerencia_id')->nullable()->constrained('gerencias')->nullOnDelete();
            $table->foreignId('tipo_usuario_id')->nullable()->constrained('tipo_usuario_ch')->nullOnDelete();
            $table->boolean('tipos_usuario_ch')->default(false);
            $table->string('name');
            $table->string('usuario', 20)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
