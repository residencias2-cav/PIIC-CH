<?php

namespace Database\Seeders;

use App\Models\TipoSangre;
use Illuminate\Database\Seeder;

class TipoSangreSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $nombre) {
            TipoSangre::query()->firstOrCreate(['nombre' => $nombre]);
        }
    }
}
