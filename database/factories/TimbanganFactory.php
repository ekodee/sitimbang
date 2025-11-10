<?php

namespace Database\Factories;

use App\Models\Supir;
use App\Models\Truk;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimbanganFactory extends Factory
{
    public function definition(): array
    {
        // $beratTruk = fake()->numberBetween(6000, 9000);
        $beratSampah = fake()->numberBetween(1000, 6000);

        return [
            // 'truk_id' => Truk::inRandomOrder()->value('truk_id'),
            // 'supir_id' => Supir::inRandomOrder()->value('supir_id'),
            'status' => fake()->randomElement(['Selesai', 'Proses', 'Menunggu']),
            // 'berat_total' => $beratTruk + $beratSampah,
            // 'berat_truk' => $beratTruk,
            'berat_sampah' => $beratSampah,
            'nama_petugas' => fake()->name(),
            'waktu_masuk' => fake()->dateTimeBetween('2024-01-01', '2025-12-31', 'Asia/Jakarta'),
        ];
    }
}
