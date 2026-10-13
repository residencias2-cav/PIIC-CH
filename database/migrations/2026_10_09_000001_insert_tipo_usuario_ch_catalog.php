<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const TYPES = [
        'Administrador',
        'Recursos Humanos',
        'Consulta',
    ];

    public function up(): void
    {
        $now = now();

        foreach (self::TYPES as $name) {
            DB::table('tipo_usuario_ch')->insertOrIgnore([
                'nombre' => $name,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        foreach (self::TYPES as $name) {
            $type = DB::table('tipo_usuario_ch')->where('nombre', $name)->first();

            if ($type === null) {
                continue;
            }

            $isAssigned = DB::table('users')
                ->where('tipo_usuario_id', $type->id)
                ->exists();

            if (! $isAssigned) {
                DB::table('tipo_usuario_ch')->where('id', $type->id)->delete();
            }
        }
    }
};
