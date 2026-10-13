<?php

namespace Database\Factories;

use App\Models\TipoSangre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TipoSangre>
 */
class TipoSangreFactory extends Factory
{
    protected $model = TipoSangre::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
        ];
    }
}
