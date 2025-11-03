<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupirFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'no_ktp' => fake()->numerify('3171#############'),
            'no_hp' => fake()->phoneNumber(),
            'created_at' => now(),
        ];
    }
}
