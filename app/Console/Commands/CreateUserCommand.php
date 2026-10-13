<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreateUserCommand extends Command
{
    protected $signature = 'users:create';

    protected $description = 'Create an authorized account for the HR system';

    public function handle(): int
    {
        $name = $this->ask('Nombre');
        $username = $this->ask('Usuario');
        $email = $this->ask('Correo');
        $workerId = $this->ask('ID del trabajador (opcional)');
        $gerenciaId = $this->ask('ID de la gerencia (opcional)');
        $roleId = $this->ask('ID del tipo de usuario (opcional)');
        $password = $this->secret('Contraseña (mínimo 12 caracteres)');
        $confirmation = $this->secret('Confirma la contraseña');

        if ($password !== $confirmation) {
            $this->error('Las contraseñas no coinciden.');

            return self::FAILURE;
        }

        try {
            $data = Validator::make([
                'name' => $name,
                'usuario' => $username,
                'email' => $email,
                'trabajador_id' => $workerId ?: null,
                'gerencia_id' => $gerenciaId ?: null,
                'tipo_usuario_id' => $roleId ?: null,
                'password' => $password,
            ], [
                'name' => ['required', 'string', 'max:255'],
                'usuario' => ['required', 'string', 'max:20', Rule::unique('users', 'usuario')],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
                'trabajador_id' => ['nullable', 'integer', Rule::exists('trabajadors', 'id')],
                'gerencia_id' => ['nullable', 'integer', Rule::exists('gerencias', 'id')],
                'tipo_usuario_id' => ['nullable', 'integer', Rule::exists('tipo_usuario_ch', 'id')],
                'password' => ['required', 'string', 'min:12'],
            ])->validate();
        } catch (ValidationException $exception) {
            foreach ($exception->errors() as $messages) {
                foreach ($messages as $message) {
                    $this->error($message);
                }
            }

            return self::FAILURE;
        }

        User::query()->create($data);

        $this->info('La cuenta autorizada quedó creada.');

        return self::SUCCESS;
    }
}
