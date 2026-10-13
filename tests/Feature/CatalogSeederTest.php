<?php

namespace Tests\Feature;

use App\Models\EstadoCivil;
use App\Models\LugarNacimiento;
use App\Models\Parentesco;
use App\Models\TipoSangre;
use App\Models\TipoUsuarioCh;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CatalogSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_seeders_are_safe_to_run_more_than_once(): void
    {
        Artisan::call('db:seed');
        Artisan::call('db:seed');

        $this->assertSame(5, EstadoCivil::query()->count());
        $this->assertSame(8, TipoSangre::query()->count());
        $this->assertSame(33, LugarNacimiento::query()->count());
        $this->assertSame(6, Parentesco::query()->count());
        $this->assertSame(
            ['Administrador', 'Consulta', 'Recursos Humanos'],
            TipoUsuarioCh::query()->orderBy('nombre')->pluck('nombre')->all()
        );
    }

    public function test_account_types_are_added_by_a_database_migration(): void
    {
        $this->assertSame(
            ['Administrador', 'Consulta', 'Recursos Humanos'],
            TipoUsuarioCh::query()->orderBy('nombre')->pluck('nombre')->all()
        );
    }
}
