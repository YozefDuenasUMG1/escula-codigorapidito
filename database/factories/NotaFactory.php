<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nota>
 */
class NotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_inscripcion' => \App\Models\Inscripcion::factory(),
            'punteo' => $this->faker->numberBetween(0, 100),
            'observacion' => $this->faker->sentence(10),
        ];
    }
}
