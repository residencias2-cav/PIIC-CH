<?php

namespace Database\Seeders;

use App\Models\TipoUsuarioCh;
use Illuminate\Database\Seeder;

class TipoUsuarioChSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Administrador', 'Recursos Humanos', 'Consulta'] as $nombre) {
            TipoUsuarioCh::query()->firstOrCreate(['nombre' => $nombre]);
        }
    }
}
