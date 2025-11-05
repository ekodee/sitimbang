<?php

namespace Database\Seeders;

use App\Models\Timbangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Timbangan::factory(10)->create();
    }
}
