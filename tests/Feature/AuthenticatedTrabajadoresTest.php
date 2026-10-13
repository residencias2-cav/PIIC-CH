<?php

namespace Tests\Feature;

use App\Livewire\Trabajadores\Index;
use App\Models\Domicilio;
use App\Models\EstadoCivil;
use App\Models\LugarNacimiento;
use App\Models\TipoSangre;
use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class AuthenticatedTrabajadoresTest extends TestCase
{
    use RefreshDatabase;

    public function test_worker_records_require_an_authorized_login_and_public_registration_is_disabled(): void
    {
        $this->get('/login')->assertOk();
        $this->get('/trabajadores')->assertRedirect('/login');
        $this->get('/register')->assertNotFound();
        $this->post('/register')->assertNotFound();
    }

    public function test_authorized_user_can_login_and_logout(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect('/trabajadores');

        $this->assertAuthenticatedAs($user);
        $this->get('/trabajadores')->assertOk();

        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_authorized_account_can_be_provisioned_from_the_console(): void
    {
        $this->artisan('users:create')
            ->expectsQuestion('Nombre', 'Personal de RH')
            ->expectsQuestion('Usuario', 'personal-rh')
            ->expectsQuestion('Correo', 'rh@example.test')
            ->expectsQuestion('ID del trabajador (opcional)', '')
            ->expectsQuestion('ID de la gerencia (opcional)', '')
            ->expectsQuestion('ID del tipo de usuario (opcional)', '')
            ->expectsQuestion('Contraseña (mínimo 12 caracteres)', 'contraseña-segura-2026')
            ->expectsQuestion('Confirma la contraseña', 'contraseña-segura-2026')
            ->expectsOutput('La cuenta autorizada quedó creada.')
            ->assertExitCode(0);

        $user = User::query()->where('email', 'rh@example.test')->firstOrFail();

        $this->assertTrue(Hash::check('contraseña-segura-2026', $user->password));
        $this->assertSame('personal-rh', $user->usuario);
    }

    public function test_authorized_user_can_create_and_update_a_worker_with_one_address(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $ids = [
            'lugar_nacimiento_id' => LugarNacimiento::query()->where('nombre', 'Chihuahua')->value('id'),
            'tipo_sangre_id' => TipoSangre::query()->where('nombre', 'O+')->value('id'),
            'estado_civil_id' => EstadoCivil::query()->where('nombre', 'Soltero')->value('id'),
        ];

        $component = Livewire::actingAs($user)
            ->test(Index::class)
            ->set('form.nt', 'RH-00001')
            ->set('form.nombre', 'Ana')
            ->set('form.apellido_paterno', 'Lopez')
            ->set('form.apellido_materno', 'Garcia')
            ->set('form.sexo', 'mujer')
            ->set('form.curp', 'ABCD900101HCHRRR01')
            ->set('form.fecha_nacimiento', '1990-01-01')
            ->set('form.lugar_nacimiento_id', $ids['lugar_nacimiento_id'])
            ->set('form.tipo_sangre_id', $ids['tipo_sangre_id'])
            ->set('form.estado_civil_id', $ids['estado_civil_id'])
            ->set('form.celular', '6141234567')
            ->set('form.direccion', 'Calle Primera 123')
            ->set('form.colonia', 'Centro')
            ->set('form.municipio', 'Chihuahua')
            ->set('form.cp', '01234')
            ->call('save')
            ->assertHasNoErrors();

        $trabajador = Trabajador::query()->where('nt', 'RH-00001')->firstOrFail();

        $component->call('edit', $trabajador->id)
            ->set('form.direccion', 'Calle Segunda 456')
            ->set('form.cp', '31000')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('domicilios', [
            'trabajador_id' => $trabajador->id,
            'direccion' => 'Calle Segunda 456',
            'cp' => '31000',
        ]);
        $this->assertSame(1, Domicilio::query()->where('trabajador_id', $trabajador->id)->count());
    }
}
