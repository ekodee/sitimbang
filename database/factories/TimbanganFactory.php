<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timbangan>
 */
class TimbanganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plat_nomer' => fake()->regexify('[A-Z]{1,2} [0-9]{4} [A-Z]{2,3}'),
            'nama_supir' => fake()->name(),
            'berat_total' => fake()->numberBetween(1000, 8000),
            'berat_truk' => fake()->numberBetween(1000, 8000),
            'berat_sampah' => fake()->numberBetween(1000, 8000),
            'nama_petugas' => fake()->name(),
            'created_at' => fake()->dateTime('now', 'GMT'),
        ];
    }
}
