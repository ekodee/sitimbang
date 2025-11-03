<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrukFactory extends Factory
{
    public function definition(): array
    {
        return [
            'no_polisi' => strtoupper(fake()->regexify('[A-Z]{1,2}[0-9]{4}[A-Z]{2,3}')),
            'jenis_truk' => fake()->randomElement(['Dump Truck', 'Compactor', 'Arm Roll', 'Bak Terbuka']),
            'berat_truk' => fake()->numberBetween(5000, 10000),
            'created_at' => now(),
        ];
    }
}
