<?php

namespace Database\Factories;

use App\Models\Colegiado;
use Illuminate\Database\Eloquent\Factories\Factory;


class ColegiadoFactory extends Factory
{
    protected $model = Colegiado::class;

    
     
    public function definition(): array
    {
        $capitulos = [
            'Ingeniería de Sistemas',
            'Ingeniería Civil',
            'Ingeniería Industrial',
            'Ingeniería Electrónica',
            'Ingeniería Mecánica',
            'Ingeniería Química',
        ];

        return [
            'cip' => (string) fake()->unique()->numberBetween(100000, 999999),
            'nombres' => fake()->firstName(),
            'apellidos' => fake()->lastName() . ' ' . fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'capitulo' => fake()->randomElement($capitulos),
            'habilitado' => true,
            'cuotas_pendientes' => fake()->numberBetween(0, 5),
        ];
    }

    /**
     * Estado para colegiado puntual (100% habilitado y al día).
     */
    public function puntual(): static
    {
        return $this->state(fn (array $attributes) => [
            'habilitado' => true,
            'cuotas_pendientes' => 0,
        ]);
    }

    /**
     * Estado para colegiado inhabilitado/moroso.
     */
    public function inhabilitado(): static
    {
        return $this->state(fn (array $attributes) => [
            'habilitado' => false,
            'cuotas_pendientes' => 4,
        ]);
    }
}
