<?php

namespace Tests\Feature;

use App\Models\EstadoCivil;
use App\Models\Domicilio;
use App\Models\InformacionPersonal;
use App\Models\Trabajador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrabajadorRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_trabajador_relations_resolve_using_the_schema_table_names(): void
    {
        $trabajador = Trabajador::factory()->create();
        $estadoCivil = EstadoCivil::factory()->create();
        $trabajadorId = $trabajador->id;

        $informacion = $trabajador->informacionPersonal()->create([
            'estado_civil_id' => $estadoCivil->id,
            'celular' => '5551234567',
            'licencia_conducir' => true,
        ]);

        $this->assertSame($trabajador->id, $informacion->trabajador->id);
        $this->assertSame($estadoCivil->id, $informacion->estadoCivil->id);
        $this->assertTrue($informacion->licencia_conducir);
        $this->assertSame($trabajador->id, $trabajador->fresh()->informacionPersonal->trabajador_id);
        $this->assertDatabaseHas('trabajadors', ['id' => $trabajadorId]);
    }

    public function test_a_worker_has_one_address_that_can_be_updated_without_creating_another(): void
    {
        $trabajador = Trabajador::factory()->create();

        $domicilio = $trabajador->domicilio()->create([
            'direccion' => 'Calle Primera 123',
            'colonia' => 'Centro',
            'municipio' => 'Chihuahua',
            'cp' => '01234',
        ]);

        $trabajador->domicilio()->update([
            'direccion' => 'Calle Segunda 456',
            'colonia' => 'Norte',
            'municipio' => 'Chihuahua',
            'cp' => '31000',
        ]);

        $this->assertSame(1, Domicilio::query()->where('trabajador_id', $trabajador->id)->count());
        $this->assertSame($domicilio->id, $trabajador->fresh()->domicilio->id);
        $this->assertSame('Calle Segunda 456', $trabajador->fresh()->domicilio->direccion);
    }
}
