<?php

namespace Database\Factories;

use App\Models\LugarNacimiento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LugarNacimiento>
 */
class LugarNacimientoFactory extends Factory
{
    protected $model = LugarNacimiento::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->city(),
        ];
    }
}
