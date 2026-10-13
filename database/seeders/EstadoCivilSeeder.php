<?php

namespace Database\Seeders;

use App\Models\EstadoCivil;
use Illuminate\Database\Seeder;

class EstadoCivilSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Soltero', 'Casado', 'Divorciado', 'Viudo', 'Unión libre'] as $nombre) {
            EstadoCivil::query()->firstOrCreate(['nombre' => $nombre]);
        }
    }
}
