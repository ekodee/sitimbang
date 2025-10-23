<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supir>
 */
class SupirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'truk_id' => fake()->randomElement([1,2,3,4,5]),
            'nama' => fake()->name(),
            'no_ktp' => fake()->numerify(str_repeat('#', 16)),
            'no_hp' => fake()->phoneNumber(),
            'created_at' => now(),
        ];
    }
}
