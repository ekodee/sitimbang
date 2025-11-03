<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatans = [
            ['kode' => '3671010', 'nama' => 'Ciledug'],
            ['kode' => '3671020', 'nama' => 'Larangan'],
            ['kode' => '3671030', 'nama' => 'Karang Tengah'],
            ['kode' => '3671040', 'nama' => 'Cipondoh'],
            ['kode' => '3671050', 'nama' => 'Pinang'],
            ['kode' => '3671060', 'nama' => 'Tangerang'],
            ['kode' => '3671070', 'nama' => 'Karawaci'],
            ['kode' => '3671080', 'nama' => 'Jatiuwung'],
            ['kode' => '3671090', 'nama' => 'Cibodas'],
            ['kode' => '3671100', 'nama' => 'Periuk'],
            ['kode' => '3671110', 'nama' => 'Batuceper'],
            ['kode' => '3671120', 'nama' => 'Neglasari'],
            ['kode' => '3671130', 'nama' => 'Benda'],
        ];
        DB::table('kecamatans')->insert($kecamatans);
    }
}
