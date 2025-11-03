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
            'status' => fake()->randomElement(['Selesai', 'Proses', 'Menunggu']),
            'berat_total' => $beratTruk + $beratSampah,
            'berat_truk' => $beratTruk,
            'berat_sampah' => $beratSampah,
            'nama_petugas' => fake()->name(),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
