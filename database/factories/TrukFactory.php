<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Truk>
 */
class TrukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_polisi' => fake()->regexify('[A-Z]{1,2}[0-9]{4}[A-Z]{2,3}'),
            'jenis_truk' => fake()->randomElement(['Light', 'Medium', 'Heavy']),
            'berat_truk' => fake()->numberBetween(1000, 8000),
            'created_at' => now(),
        ];
    }
}
