<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimbanganFactory extends Factory
{
    public function definition(): array
    {
        $beratTruk = fake()->numberBetween(6000, 9000);
        $beratSampah = fake()->numberBetween(1000, 6000);

        return [
            'truk_id' => fake()->numberBetween(1, 20),
            'supir_id' => fake()->numberBetween(1, 100),
            'status' => fake()->randomElement(['Selesai', 'Proses', 'Menunggu']),
            'berat_total' => $beratTruk + $beratSampah,
            'berat_truk' => $beratTruk,
            'berat_sampah' => $beratSampah,
            'nama_petugas' => fake()->name(),
            'created_at' => fake()->randomElement(['2025-11-5 12:59:08', '2025-11-4 12:59:08']),
        ];
    }
}
