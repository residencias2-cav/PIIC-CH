<?php

namespace Database\Factories;

use App\Models\EstadoCivil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EstadoCivil>
 */
class EstadoCivilFactory extends Factory
{
    protected $model = EstadoCivil::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->randomElement(['Soltero', 'Casado', 'Divorciado', 'Viudo']),
        ];
    }
}
