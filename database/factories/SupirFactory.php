<?php

namespace Database\Factories;

use App\Models\Kecamatan;
use App\Models\Truk;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupirFactory extends Factory
{
    public function definition(): array
    {
        return [
            // 'truk_id' => Truk::inRandomOrder()->value('truk_id'),
            // 'kecamatan_id' => Kecamatan::inRandomOrder()->value('kecamatan_id'),
            'nama' => fake()->name(),
            'upt' => fake()->randomElement(['Barat', 'Timur']),
            'no_ktp' => fake()->numerify('3171#############'),
            'no_hp' => fake()->phoneNumber(),
        ];
    }
}
