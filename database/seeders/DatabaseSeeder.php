<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EstadoCivilSeeder::class,
            TipoSangreSeeder::class,
            LugarNacimientoSeeder::class,
            ParentescoSeeder::class,
            TipoUsuarioChSeeder::class,
        ]);
    }
}
