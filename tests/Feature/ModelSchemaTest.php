<?php

namespace Tests\Feature;

use App\Models\Clinico;
use App\Models\ContactoEmergencia;
use App\Models\Contrato;
use App\Models\Curso;
use App\Models\Departamento;
use App\Models\DependienteFamiliar;
use App\Models\Domicilio;
use App\Models\EquipoAsignado;
use App\Models\EquipoElectronico;
use App\Models\EquipoSeguridad;
use App\Models\EppAsignado;
use App\Models\Escolaridad;
use App\Models\EstadoCivil;
use App\Models\FallaEquipoElectronico;
use App\Models\Gerencia;
use App\Models\HistorialTrabajador;
use App\Models\Incapacidad;
use App\Models\InformacionPersonal;
use App\Models\LugarNacimiento;
use App\Models\Obra;
use App\Models\Parentesco;
use App\Models\Psicologia;
use App\Models\Puesto;
use App\Models\Sancion;
use App\Models\TipoSangre;
use App\Models\TipoUsuarioCh;
use App\Models\Trabajador;
use App\Models\User;
use App\Models\Vacacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ModelSchemaTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_model_maps_to_a_table_created_by_the_migrations(): void
    {
        $models = [
            Clinico::class,
            ContactoEmergencia::class,
            Contrato::class,
            Curso::class,
            Departamento::class,
            DependienteFamiliar::class,
            Domicilio::class,
            EquipoAsignado::class,
            EquipoElectronico::class,
            EquipoSeguridad::class,
            EppAsignado::class,
            Escolaridad::class,
            EstadoCivil::class,
            FallaEquipoElectronico::class,
            Gerencia::class,
            HistorialTrabajador::class,
            Incapacidad::class,
            InformacionPersonal::class,
            LugarNacimiento::class,
            Obra::class,
            Parentesco::class,
            Psicologia::class,
            Puesto::class,
            Sancion::class,
            TipoSangre::class,
            TipoUsuarioCh::class,
            Trabajador::class,
            User::class,
            Vacacion::class,
        ];

        foreach ($models as $modelClass) {
            /** @var Model $model */
            $model = new $modelClass;

            $this->assertTrue(
                Schema::hasTable($model->getTable()),
                "{$modelClass} maps to missing table {$model->getTable()}."
            );
        }
    }

    public function test_an_account_can_be_linked_to_its_worker_management_area_and_type(): void
    {
        $this->seed();

        $trabajador = Trabajador::factory()->create();
        $gerencia = Gerencia::query()->create(['nombre' => 'Recursos Humanos']);
        $tipoUsuario = TipoUsuarioCh::query()->create(['nombre' => 'Administración']);
        $user = User::query()->create([
            'trabajador_id' => $trabajador->id,
            'gerencia_id' => $gerencia->id,
            'tipo_usuario_id' => $tipoUsuario->id,
            'tipos_usuario_ch' => true,
            'name' => 'Cuenta RH',
            'usuario' => 'cuenta-rh',
            'email' => 'cuenta-rh@example.test',
            'password' => 'contraseña-segura',
        ]);

        $this->assertSame($trabajador->id, $user->trabajador->id);
        $this->assertSame($gerencia->id, $user->gerencia->id);
        $this->assertSame($tipoUsuario->id, $user->tipoUsuario->id);
        $this->assertSame($user->id, $trabajador->usuarioCuenta->id);
        $this->assertSame($user->id, $gerencia->usuarios->sole()->id);
        $this->assertSame($user->id, $tipoUsuario->usuarios->sole()->id);
        $this->assertTrue($user->tipos_usuario_ch);
        $this->assertNotSame('contraseña-segura', $user->password);
        $this->assertFalse(Schema::hasColumn('users', 'contraseña_correo'));
        $this->assertFalse(Schema::hasColumn('historial_trabajadores', 'correo_pass'));
    }
}
