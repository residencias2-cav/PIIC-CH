<?php

namespace Database\Seeders;

use App\Models\Parentesco;
use Illuminate\Database\Seeder;

class ParentescoSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Madre', 'Padre', 'Cónyuge', 'Hijo/a', 'Hermano/a', 'Otro'] as $nombre) {
            Parentesco::query()->firstOrCreate(['nombre' => $nombre]);
        }
    }
}
