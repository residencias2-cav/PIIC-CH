<?php

namespace Database\Factories;

use App\Models\LugarNacimiento;
use App\Models\TipoSangre;
use App\Models\Trabajador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trabajador>
 */
class TrabajadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nt' => fake()->unique()->numerify('EMP-#####'),
            'nombre' => fake()->firstName(),
            'apellido_paterno' => fake()->lastName(),
            'apellido_materno' => fake()->optional()->lastName(),
            'sexo' => fake()->randomElement(['hombre', 'mujer']),
            'nss' => fake()->optional()->numerify('###########'),
            'curp' => fake()->unique()->bothify('??????????????????'),
            'rfc' => fake()->optional()->bothify('?????????????'),
            'fecha_nacimiento' => fake()->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
            'lugar_nacimiento_id' => LugarNacimiento::factory(),
            'tipo_sangre_id' => TipoSangre::factory(),
        ];
    }
}
